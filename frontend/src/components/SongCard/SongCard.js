import React from "react";
import "./SongCard.css";

export default function AlbumCard() {
  return (
    <div className="sg-card">
      <div className="sg-card-image">
        <img className="song-image"
          src="https://storage.googleapis.com/inbox-zero/2880x/saad-chaudhry-G25LeMV7fAw-unsplash.jpg"
          alt="song cover"
        />
      </div>
      <div className="sg-card-content">
        <div className="song-title">Song Title</div>
        <div className="sg-artist-name">Artist Name</div>
      </div>
    </div>
  );
}
