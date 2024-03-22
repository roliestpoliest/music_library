import { React, useState, useEffect } from "react";
import "./Insert.css";
import axios from "axios";

export default function Events() {
  //const [event_id, setEvent_id] = useState();
  const [title, setTitle] = useState();
  const [description, setDescription] = useState();
  const [date, setDate] = useState();
  const [start_time, setStart_time] = useState();
  const [end_time, setEnd_time] = useState();
  const [region, setRegion] = useState();
  const [artist_id, setArtist_id] = useState();

  const [complete, setComplete] = useState(false);


  const handleSumbitEvents = (e) => {
    e.preventDefault();
    console.log("foo");
    console.log(
      `${title}, ${description}, ${date}, ${start_time}, ${end_time}, ${region}, ${artist_id}`
    );

    axios
    .post("http://localhost:8888/api/events.php", {
      event_id: null,
      title: title,
      description: description,
      date: date,
      start_time: start_time,
      end_time: end_time,
      region: region,
      artist_id: artist_id
    })
    .then((response) => {
      console.log(response.data)
    }); 
};

  return (
    <div>
      <form>
        <h1>Event</h1>
        {/*
        <div>
          <label>Event ID</label>
          <input
            type="text"
            className="Events"
            onChange={(e) => setEvent_id(e.target.value)}
          />
        </div>
        */}

        <div>
          <label>Title</label>
          <input
            type="text"
            className="Events"
            onChange={(e) => setTitle(e.target.value)}
          />
        </div>
        <div>
          <label>Description</label>
          <input
            type="text"
            className="Events"
            onChange={(e) => setDescription(e.target.value)}
          />
        </div>
        <div>
          <label>Date</label>
          <input
            type="date"
            className="Events"
            onChange={(e) => setDate(e.target.value)}
          />
        </div>
        <div>
          <label>Start Time</label>
          <input
            type="time"
            className="Events"
            onChange={(e) => setStart_time(e.target.value)}
          />
        </div>
        <div>
          <label>End Time</label>
          <input
            type="time"
            className="Events"
            onChange={(e) => setEnd_time(e.target.value)}
          />
        </div>
        <div>
          <label>Region</label>
          <select
            className="Accounts"
            onChange={(e) => setRegion(e.target.value)}
          >
            <option value="none" selected disabled hidden>
              Select an Option
            </option>
            <option value="NE">Northeast</option>
            <option value="SW">Southwest</option>
            <option value="W">West</option>
            <option value="SE">Southeast</option>
            <option value="MW">Midwest</option>
          </select>
        </div>
        <div>
          <label>Artist ID</label>
          <input
            type="text"
            className="Events"
            onChange={(e) => setArtist_id(e.target.value)}
          />
        </div>
        <button onClick={handleSumbitEvents}>Submit</button>
      </form>
    </div>
  );
}
