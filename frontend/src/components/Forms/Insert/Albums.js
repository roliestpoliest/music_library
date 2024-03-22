import { React, useState, useEffect } from "react";
import "./Insert.css";
import axios from "axios";

export default function Albums() {
  const [recordLabel, setRecordLabel] = useState();
  const [artist, setArtist] = useState();
  const [title, setTitle] = useState();
  const [format, setFormat] = useState();
  const [release_date, setReleaseDate] = useState();
  const [rating, setRating] = useState();
  const [image_path, setImagePath] = useState();

  const [artists, setArtists] = useState([]);
  useEffect(() => {
    async function fetchArtistData() {
      try {
        const response = await axios.get(
          "http://localhost:8888/api/artists/names.php"
        );
        setArtists(response.data);
      } catch (error) {
        console.error("Error fetching artist data:", error);
      }
    }

    fetchArtistData();
  }, []);

  const handleSubmitAlbums = async (e) => {
    e.preventDefault();
    console.log(
      `${recordLabel}, ${artist}, ${title}, ${format}, ${release_date}`
    );
    const toNullIfEmpty = (value) => (value === "" ? null : value);

    try {
      const response = await axios.post(
        "http://localhost:8888/api/albums.php",
        {
          album_id: null,
          record_label: toNullIfEmpty(recordLabel),
          artist_id: toNullIfEmpty(artist),
          title: toNullIfEmpty(title),
          format: toNullIfEmpty(format),
          release_date: toNullIfEmpty(release_date),
          rating: 0,
          image_path: null,
        }
      );
      console.log(response.data);
    } catch (error) {
      console.error("There was an error!", error.response);
    }
  };

  return (
    <div className="albums-body">
      <form>
        <h1>Album</h1>
        <div>
          <label>Record Label</label>
          <input
            type="text"
            className="Albums"
            onChange={(e) => setRecordLabel(e.target.value)}
          />
        </div>
        <div>
          <label>Artist</label>
          <select
            className="Albums"
            onChange={(e) => setArtist(e.target.value)}
          >
            <option value="none" selected disabled hidden>
              Select an Option
            </option>
            {artists.map((artist) => (
              <option key={artist.artist_id} value={artist.artist_id}>
                {artist.fname} {artist.lname}
              </option>
            ))}
          </select>{" "}
        </div>
        <div>
          <label>Title</label>
          <input
            type="text"
            className="Albums"
            onChange={(e) => setTitle(e.target.value)}
          />
        </div>
        <div>
          <label>Format</label>
          <select
            className="Accounts"
            onChange={(e) => setFormat(e.target.value)}
          >
            <option value="none" selected disabled hidden>
              Select an Option
            </option>
            <option value="Album">Album</option>
            <option value="Single">Single</option>
            <option value="EP">EP</option>
            <option value="LP">LP</option>
            <option value="SP">SP</option>
          </select>
        </div>
        <div>
          <label>Release Date</label>
          <input
            type="date"
            className="Albums"
            onChange={(e) => setReleaseDate(e.target.value)}
          />
        </div>
        {/* <div>
          <label>Rating</label>
          <input
          type="number"
          className="Albums"
          onChange={(e) => setRating(e.target.value)}
          />
        </div> */}
        <div>
          <label>Image Path</label>
          <input
            type="text"
            className="Albums"
            onChange={(e) => setImagePath(e.target.value)}
          />
        </div>
        <div>TBA songs in album</div>
        <button onClick={handleSubmitAlbums}>Submit</button>
      </form>
    </div>
  );
}
