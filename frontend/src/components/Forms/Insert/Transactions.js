import { React, useState, useEffect } from "react";
import "./Insert.css";
import axios from "axios";

export default function Transactions() {
  return (
    <div>
      <form>
        <h1>Transaction</h1>
        not actual fields
        <div>
          <label>Transaction Type</label>
          <input
            type="text"
            className="Transactions"
          />
        </div>
        <div>
          <label>Transaction Date</label>
          <input
            type="text"
            className="Transactions"
          />
        </div>
        <div>
          <label>Amount</label>
          <input
            type="text"
            className="Transactions"
          />
        </div>
        <button>Submit</button>
      </form>
    </div>
  )
}
