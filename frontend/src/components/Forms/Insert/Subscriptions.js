import { React, useState, useEffect } from "react";
import "./Insert.css";
import axios from "axios";

export default function Subscriptions() {
  const [account, setAccount] = useState(1);
  //Subscriptions
  const [start_date, setStartDate] = useState();
  const [end_date, setEndDate] = useState();
  const [length, setLength] = useState();
  const [price, setPrice] = useState();
  const [description, setDescription] = useState();

  //Transactions
  const [payment_source, setPaymentSource] = useState();
  const [total, setTotal] = useState();

  const calculatePrice = (length) => {
    switch (length) {
      case "1 Month":
        return 9.99;
      case "3 Months":
        return 24.99;
      case "6 Months":
        return 49.99;
      case "12 Months":
        return 99.99;
      default:
        return -1;
    }
  };

  const calculateTotal = (price) => {
    const total = price * 1.0825;
    return total;
  };

  const calculateDates = (length) => {
    let start = new Date();
    let end = new Date(start.getTime());

    switch (length) {
      case "1 Month":
        end.setMonth(end.getMonth() + 1);
        break;
      case "3 Months":
        end.setMonth(end.getMonth() + 3);
        break;
      case "6 Months":
        end.setMonth(end.getMonth() + 6);
        break;
      case "12 Months":
        end.setMonth(end.getMonth() + 12);
        break;
      default:
        console.log("Invalid length");
        return null;
    }

    const startStr = start.toISOString().slice(0, 19).replace("T", " ");
    const endStr = end.toISOString().slice(0, 19).replace("T", " ");

    setStartDate(startStr);
    setEndDate(endStr);
  };

  const handleLength = (length) => {
    setLength(length);
    calculateDates(length);
    
    const calculatedPrice = calculatePrice(length);
    setPrice(calculatedPrice);
    setTotal(calculateTotal(calculatedPrice));
  };

  const handleSubmitSubscriptions = async (e) => {
    e.preventDefault();
    //start_date, end_date, length, price, description
    console.log(`${start_date}, ${end_date}, ${length}, ${price}, ${description}`);
    console.log(`${account}, ${payment_source}, ${total}`);

    const toNullIfEmpty = (value) => (value === "" ? null : value);

    try {
      const response = await axios.post(
        window.$domain + "subscriptions.php",
        {
          subscription_id: null,
          account_id: toNullIfEmpty(account),
          start_date: toNullIfEmpty(start_date),
          end_date: toNullIfEmpty(end_date),
          length: toNullIfEmpty(length),
          price: toNullIfEmpty(price),
          description: null,
        }
      );
      console.log(response.data);
    }catch (error) {
      console.error("There was an error!", error.response);
    }
  };

  const handleSubmitTransactions = async (e) => {
    e.preventDefault();
    console.log(`${account}, ${payment_source}, ${total}`);

    const toNullIfEmpty = (value) => (value === "" ? null : value);

    try {
      const response = await axios.post(
        window.$domain + "transactions.php",
        {
          transaction_id: null,
          account_id: toNullIfEmpty(account),
          payment_date: toNullIfEmpty(start_date),
          payment_source: toNullIfEmpty(payment_source),
          total: toNullIfEmpty(total),
        }
      );
      console.log(response.data);
    }catch (error) {
      console.error("There was an error!", error.response);
    }
  }

  const handleBothSubmissions = (e) => {
    e.preventDefault();
    handleSubmitSubscriptions(e);
    handleSubmitTransactions(e);
  };

  return (
    <div className="insert-body">
      <form>
        <h1>Subscription</h1>
        <div>
          <label>Length</label>
          <select
            className="Subscriptions"
            onChange={(e) => handleLength(e.target.value)}
          >
            <option value="none" selected disabled hidden>
              Select an Option
            </option>
            <option value="1 Month">1 Month</option>
            <option value="6 Months">6 Months</option>
            <option value="12 Months">12 Months</option>
          </select>
        </div>
        <div>
          <label>Payment Source</label>
          <input
            type="text"
            className="Transactions"
            onChange={(e) => setPaymentSource(e.target.value)}
          />
        </div>
        <button onClick={handleBothSubmissions}>Submit</button>
      </form>
    </div>
  );
}
