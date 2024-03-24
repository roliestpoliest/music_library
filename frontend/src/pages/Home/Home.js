import { React, useState, useEffect } from "react";
import axios from "axios";
import "./Home.css";
import Sidebar from "../../components/Sidebar/Sidebar";
import Navbar from "../../components/Navbar/Navbar";
import MusicPlayer from "../../components/MusicPlayer/MusicPlayer";
import AlbumCard from "../../components/AlbumCard/AlbumCard";
import ArtistCard from "../../components/ArtistCard/ArtistCard";

export default function Home() {
  const [albumData, setAlbumData] = useState([]);

  useEffect(() => {
    async function fetchSongData() {
      const url = window.apiUrl + "albums.php";
      try {
        const response = await axios.get(url, {
          headers: {
            "Authorization" : localStorage.getItem("token"),
          }
        });
        console.log(response.data);
        setAlbumData(response.data);
        // console.log(albumData);
      } catch (error) {
        console.error("Error fetching song data:", error);
      }
    }
    fetchSongData();
  }, []);
  return (
    <div className="Home">
      <div className="body">
        <Sidebar />
        <div className="content">
          <Navbar />
          <div className="display">
            <div className="cards">
              <AlbumCard />
               <AlbumCard />
              <AlbumCard />
              <ArtistCard />
              <ArtistCard /> 
            </div>
          </div>
        </div>
      </div>
      <MusicPlayer />
    </div>
  );
}
