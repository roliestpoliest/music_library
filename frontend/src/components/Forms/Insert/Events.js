import { React, useState, useEffect } from "react";
import "./Insert.css";
import axios from "axios";

export default function Events() {
  const [title, setTitle] = useState();
  const [description, setDescription] = useState();
  const [date, setDate] = useState();
  const [start_time, setStart_time] = useState();
  const [end_time, setEnd_time] = useState();
  const [region, setRegion] = useState();
  const [artist, setArtist] = useState();
  const [image_path, setImagePath] = useState();

  const [data, setData] = useState([]);
  useEffect(() => {
    async function fetchArtistData() {
      try {
        const response = await axios.get(
          "http://localhost:8888/api/artists/names.php"
        );
        setData(response.data);
      } catch (error) {
        console.error("Error fetching artist data:", error);
      }
    }

    fetchArtistData();
  }, []);

  const handleSubmitEvents = async (e) => {
    e.preventDefault();
    console.log(
      `${title}, ${description}, ${date}, ${start_time}, ${end_time}, ${region}, ${artist}`
    );
    const toNullIfEmpty = (value) => (value === "" ? null : value);

    try {
      const response = await axios.post(
        "http://localhost:8888/api/events.php",
        {
          event_id: null,
          title: toNullIfEmpty(title),
          description: toNullIfEmpty(description),
          date: toNullIfEmpty(date),
          start_time: toNullIfEmpty(start_time),
          end_time: toNullIfEmpty(end_time),
          region: toNullIfEmpty(region),
          artist: toNullIfEmpty(artist),
          image_path: null,
        }
      );
      console.log(response.data);
    } catch (error) {
      console.error("There was an error!", error.response);
    }
  };


  const handleSumbitEvents = (e) => {
    e.preventDefault();
    console.log("foo");
    console.log(
      `${title}, ${description}, ${date}, ${start_time}, ${end_time}, ${region}, ${artist}`
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
      artist_id: artist
    })
    .then((response) => {
      console.log(response.data)
    }); 
};

  return (
    <div className="insert-body">
      <form>
        <h1>Event</h1>
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
            className="Events"
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
        <label>Artist</label>
        <select className="Albums" onChange={(e) => setArtist(e.target.value)}>
          <option value="none" selected disabled hidden>
            Select an Option
          </option>
          {data.map((artist) => (
            <option key={artist.artist_id} value={artist.artist_id}>
              {artist.fname} {artist.lname}
            </option>
          ))}
        </select>{" "}
        <div>
          <label>Image Path</label>
          <input
            type="text"
            className="Events"
            onChange={(e) => setImagePath(e.target.value)}
          />
        </div>
        <button onClick={handleSumbitEvents}>Submit</button>
      </form>
    </div>
  );
}
