import React from 'react'
import "./ArtistAbout.css";
import Sidebar from "../../components/Sidebar/Sidebar";
import Navbar from "../../components/Navbar/Navbar";
import MusicPlayer from "../../components/MusicPlayer/MusicPlayer";

export default function ArtistAbout() {
  return (
    <div className="ArtistAbout">
      <div className="body">
        <Sidebar />
        <div className="content">
          <Navbar />
          <div className="display">
            Artist information goes here
          </div>
        </div>
      </div>
      <MusicPlayer />
    </div>
  );
}