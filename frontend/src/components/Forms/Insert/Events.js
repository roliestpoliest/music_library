import { React, useState, useEffect } from "react";
import "./Insert.css";

export default function Events() {
  const [event_id, setEvent_id] = useState();
  const [title, setTitle] = useState();
  const [description, setDescription] = useState();
  const [date, setDate] = useState();
  const [start_time, setStart_time] = useState();
  const [end_time, setEnd_time] = useState();
  const [region, setRegion] = useState();
  const [artist_id, setArtist_id] = useState();

  const [complete, setComplete] = useState(false);

  return (
    <div>
      <form>
        <h1>Event</h1>
        <div>
          <label>Event ID</label>
          <input
            type="text"
            className="Events"
            onChange={(e) => setEvent_id(e.target.value)}
          />
        </div>
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
            type="text"
            className="Events"
            onChange={(e) => setDate(e.target.value)}
          />
        </div>
        <div>
          <label>Start Time</label>
          <input
            type="text"
            className="Events"
            onChange={(e) => setStart_time(e.target.value)}
          />
        </div>
        <div>
          <label>End Time</label>
          <input
            type="text"
            className="Events"
            onChange={(e) => setEnd_time(e.target.value)}
          />
        </div>
        <div>
          <label>Region</label>
          <input
            type="text"
            className="Events"
            onChange={(e) => setRegion(e.target.value)}
          />
        </div>
        <div>
          <label>Artist ID</label>
          <input
            type="text"
            className="Events"
            onChange={(e) => setArtist_id(e.target.value)}
          />
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
  );
}
