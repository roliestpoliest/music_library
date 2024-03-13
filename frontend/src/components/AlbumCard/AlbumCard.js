import React from "react";
import "./AlbumCard.css";

export default function AlbumCard() {
  return (
    <div className="al-card">
      <div className="al-card-image">
        <img className="album-image"
          src="https://storage.googleapis.com/inbox-zero/2880x/saad-chaudhry-G25LeMV7fAw-unsplash.jpg"
          alt="album cover"
        />
      </div>
      <div className="al-card-content">
        <div className="al-album-title">Album Title</div>
        <div className="al-artist-name">Artist Name</div>
      </div>
    </div>
  );
}
