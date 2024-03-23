import { React, useState, useEffect } from "react";
import "./Insert.css";
import axios from "axios";
import Songs from "./Songs";

export default function Albums() {
  const [recordLabel, setRecordLabel] = useState();
  const [artist, setArtist] = useState();
  const [title, setTitle] = useState();
  const [format, setFormat] = useState();
  const [release_date, setReleaseDate] = useState();
  const [rating, setRating] = useState();
  const [image_path, setImagePath] = useState();

  const [songs, setSongs] = useState([]); // To store song details

  const [genre, setGenre] = useState();
  const [genres, setGenres] = useState([]);

  useEffect(() => {
    async function fetchGenreData() {
      try {
        const response = await axios.get(
          "http://localhost:8888/api/genres/GenreNames.php"
        );
        setGenres(response.data);
      } catch (error) {
        console.error("Error fetching genre data: ", error);
      }
    }
    fetchGenreData();
  }, []);

  const [artistData, setArtistData] = useState([]);
  useEffect(() => {
    async function fetchArtistData() {
      try {
        const response = await axios.get(
          "http://localhost:8888/api/artists/names.php"
        );
        setArtistData(response.data);
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
    const obj = {
      album_id: null,
      record_label: toNullIfEmpty(recordLabel),
      artist_id: toNullIfEmpty(artist),
      title: toNullIfEmpty(title),
      format: toNullIfEmpty(format),
      release_date: toNullIfEmpty(release_date),
      rating: 0,
      image_path: null,
    };

    const titles = document.getElementsByClassName("SongsName");

    for (let i = 0; i < titles.length; i++) {
      console.log(titles[i].value);
    }

    const genereList = document.getElementsByClassName("SongGenere");
    for (let i = 0; i < genereList.length; i++) {
      console.log(genereList[i].value);
    }

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

      if(titles.length === genereList.length){
        for (let i = 0; i < titles.length; i++) {
          console.log(titles[i].value);
          if (titles[i].value !== "none") {
            console.log("song_id: ", titles[i].value, "album:", response.data);
            saveSong(toNullIfEmpty(artist), titles[i].value, genereList[i].value, response.data);
          }
        }
      }

      // for (let song of songs) {
      //   try {
      //     const songResponse = await axios.post(
      //       "http://localhost:8888/api/songs.php",
      //       song
      //     );
      //     console.log(songResponse.data);
      //   } catch (error) {
      //     console.error(
      //       "There was an error submitting a song: ",
      //       error.response
      //     );
      //   }
      // }
    } catch (error) {
      console.error("There was an error!", error.response);
    }
  };

  const saveSong = (artistId, songTitle, genreId, albumId) => {
    console.log("artist_id: ", artistId, "song_title: ", songTitle, "genre_id: ", genreId);
    try {
      axios.post("http://localhost:8888/api/songs.php", {
        song_id: null,
        artist_id: artistId,
        title: songTitle,
        genre_id: genreId,
        audio_path: null,
      }).then((res) => {
        console.log(res.data);
        saveSongToAlbum(res.data, albumId);
      }
      );
    } catch (error) {
      console.error("There was an error!", error.response);
    }
  };

  const saveSongToAlbum = (songId, albumId) => {
    console.log("song_id: ", songId, "album_id: ", albumId);
    try {
      axios.post("http://localhost:8888/api/songs_in_album.php", {
        song_id: songId,
        album_id: albumId,
      }).then((res) => {
        console.log(res.data);
      }
      );
    } catch (error) {
      console.error("There was an error!", error.response);
    }
  }

  const [songsData, setSongsData] = useState([]);

  // Handle adding a song to the state
  const onSongSubmit = (song) => {
    setSongsData((currentSongs) => [...currentSongs, song]);
  };

  const [numSongs, setNumSongs] = useState(0);
  const handleSongCountChange = (e) => {
    setNumSongs(Number(e.target.value));
  };

  return (
    <div className="insert-body">
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
            {artistData.map((artist) => (
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
        <div>
          <label>Image Path</label>
          <input
            type="text"
            className="Albums"
            onChange={(e) => setImagePath(e.target.value)}
          />
        </div>

        <div className="Albums">
          <label htmlFor="song-count">How many songs are in the album?</label>
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

          {/* {[...Array(numSongs).keys()].map((n) => (
            <Songs key={n} artist={artist} onSongSubmit={onSongSubmit} />
          ))} */}
          {/* <Songs artist={artist} onSongSubmit={onSongSubmit} /> */}
        </div>
        <hr />
        <h1>Songs</h1>
        {[...Array(numSongs).keys()].map((n) => (
          <div>
            <div id="songList">
              <label>Title</label>
              <input
                type="text"
                className="SongsName"
                onChange={(e) => setTitle(e.target.value)}
              />
            </div>
            <div>
              <label>Genre</label>
              <select
                className="SongGenere"
                onChange={(e) => setGenre(e.target.value)}
              >
                <option value="none" selected disabled hidden>
                  Select an Option
                </option>
                {genres.map((genre) => (
                  <option key={genre.genre_id} value={genre.genre_id}>
                    {genre.title}
                  </option>
                ))}
              </select>{" "}
            </div>
          </div>
        ))}
        <button onClick={handleSubmitAlbums}>Submit</button>
      </form>
    </div>
  );
}
