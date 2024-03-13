import React from "react";
import "./ArtistCard.css";

export default function ArtistCard() {
  return (
    <div className="art-card">
      <div className="art-card-image">
        <img className="artist-image"
          src="https://storage.googleapis.com/inbox-zero/2880x/saad-chaudhry-G25LeMV7fAw-unsplash.jpg"
          alt="album cover"
        />
      </div>
      <div className="art-card-content">
        <div className="art-artist-name">Artist Name</div>
      </div>
    </div>
  );
}
