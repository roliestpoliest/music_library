import React from 'react'
import "./ArtistAbout.css";
import Sidebar from "../../components/Sidebar/Sidebar";
import Navbar from "../../components/Navbar/Navbar";
import MusicPlayer from "../../components/MusicPlayer/MusicPlayer";
import ArtistInfo from "../../components/ArtistInfo/ArtistInfo"


export default function ArtistAbout() {
  return (
    <div className="ArtistAbout">
      <div className="body">
        <Sidebar />
        <div className="content">
          <Navbar />
          <div className="display">
            <ArtistInfo />
          </div>
        </div>
      </div>
      <MusicPlayer />
    </div>
  );
}