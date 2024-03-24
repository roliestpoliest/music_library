import { React, useState, useEffect } from "react";
import "./Insert.css";
import axios from "axios";

export default function Playlists() {
  const [account, setAccount] = useState();
  const [title, setTitle] = useState();
  const [image_path, setImagePath] = useState();
  const [songs, setSongs] = useState([]);
  const [fileInfo, setFileInfo] = useState();

  const [songData, setSongData] = useState([]);
  useEffect(() => {
    async function fetchSongData() {
      const url = window.apiUrl + "songs.php";
      try {
        const response = await axios.get(url, {
          headers: {
            "Authorization" : localStorage.getItem("token"),
          }
        });
        console.log(response.data);
        setSongData(response.data);
      } catch (error) {
        console.error("Error fetching song data:", error);
      }
    }
    fetchSongData();
  }, []);

  const [numSongs, setNumSongs] = useState(0);
  const handleSongCountChange = (e) => {
    setNumSongs(Number(e.target.value));
  };

  const handlePlaylistImageUpload = (event) => {
    event.preventDefault();
    const file = event.target.files[0];
    setFileInfo(event.target.files[0]);
  }

  const handleSubmitPlaylists = async (e) => {
    e.preventDefault();
    console.log(`${account}, ${title}`);
    const url = window.apiUrl + "playlists.php";
    try {
      const response = await axios.post(url,
        {
          playlist_id: null,
          account_id: account,
          title: title,
          image_path: null,
          'files[]': fileInfo
        }, {
          headers: {
            "Content-Type": "multipart/form-data",
            "Authorization" : localStorage.getItem("token"),
          }
        }
      );
      console.log(response.data);
      const newPlaylistId = parseInt(response.data);
      //
      const songList = document.getElementsByClassName("SongTitle");
      for (let i = 0; i < songList.length; i++) {
        console.log(songList[i].value);
        if (songList[i].value !== "none") {
          console.log("song_id: ", songList[i].value, "account:",newPlaylistId);
          updateSong(songList[i].value, response.data);
        }
      }
      // updateSong(song_id, playlist_id);
    } catch (error) {
      console.error("There was an error!", error.response);
    }
  };

  const updateSong = (songId, playlistId) => {
    console.log("song_id: ", songId, "playlist_id: ", playlistId);
    const url = window.apiUrl + "songs_in_playlist.php";
    try {
      axios.post(url,
        {
          song_id: songId,
          playlist_id: playlistId
        }, {
          headers: {
            "Authorization" : localStorage.getItem("token"),
          }
        }).then((res) => {
          console.log(res.data);
        });
    } catch (error) {
      console.error("There was an error!", error.res);
    }
  }

  return (
    <div className="insert-body">
      <form className="inputForm">
        <h1>Playlist</h1>
        <div>
          <label>Title</label>
          <input
            type="text"
            className="Playlists"
            onChange={(e) => setTitle(e.target.value)}
          />
        </div>
        
        <div>
          <label>Image Path</label>
          <input type="file" onChange={handlePlaylistImageUpload} />
        </div>
        {/* <div>
          <label>Image Path</label>
          <input
            type="text"
            className="Playlists"
            onChange={(e) => setImagePath(e.target.value)}
          />
        </div> */}

        <div className="Playlists">
          <label htmlFor="song-count">
            How many songs are in the playlist?
          </label>
          <select
            id="song-count"
            onChange={handleSongCountChange}
            value={numSongs}
          >
            {[...Array(10).keys()].map((n) => (
              <option key={n + 1} value={n + 1}>
                {n + 1}
              </option>
            ))}
          </select>
        </div>

        <h1>Songs</h1>
        {[...Array(numSongs).keys()].map((n) => (
          <div>
            <label>Song in Playlist</label>
            <select
              className="SongTitle"
            >
              <option value="none" selected disabled hidden>
                Select an Option
              </option>
              {songData.map((song) => (
                <option key={song.song_id} value={song.song_id}>
                  {song.title}
                </option>
              ))}
            </select>{" "}
          </div>
        ))}
        <button onClick={handleSubmitPlaylists}>Submit</button>
      </form>
    </div>
  );
}
