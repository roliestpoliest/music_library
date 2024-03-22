import { React, useState, useEffect } from "react";
import Accounts from "../../components/Forms/Insert/Accounts";
import Events from "../../components/Forms/Insert/Events";
import Genres from "../../components/Forms/Insert/Genres";
import Songs from "../../components/Forms/Insert/Songs";
import Albums from "../../components/Forms/Insert/Albums";
import Playlists from "../../components/Forms/Insert/Playlists";
import Subscriptions from "../../components/Forms/Insert/Subscriptions";
import Transactions from "../../components/Forms/Insert/Transactions";
import "./Insert.css";

export default function Insert() {
  const [selectedTable, setSelectedTable] = useState("none");

  const handleChange = (e) => {
    setSelectedTable(e.target.value);
  };

  return (
    <div className="insert">
      <label htmlFor="insert-select">Select a table to insert data:</label>
      <select
        name="insert-select"
        id="insert-select"
        onChange={handleChange}
        value={selectedTable}
      >
        <option value="none" disabled hidden>
          Select a table...
        </option>
        <option value="accounts">Accounts</option>
        <option value="events">Events</option>
        <option value="genres">Genres</option>
        <option value="songs">Songs</option>
        <option value="albums">Albums</option>
        <option value="playlists">Playlists</option>
        <option value="subscriptions">Subscriptions</option>
        {/* <option value="transactions">Transactions</option> */}
      </select>
      <hr />
      {selectedTable === "accounts" && <Accounts />}
      {selectedTable === "events" && <Events />}
      {selectedTable === "genres" && <Genres />}
      {selectedTable === "songs" && <Songs />}
      {selectedTable === "albums" && <Albums />}
      {selectedTable === "playlists" && <Playlists />}
      {selectedTable === "subscriptions" && <Subscriptions />}
      {/* {selectedTable === "transactions" && <Transactions />} */}
    </div>
  );
}
