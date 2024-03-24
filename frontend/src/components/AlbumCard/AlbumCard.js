import { React, useState, useEffect } from "react";
import axios from "axios";
import "./AlbumCard.css";

export default function AlbumCard({albumData}) {

  
  return (
    <div className="al-card">
      {albumData &&
      <div>
        <div className="al-card-image">
          <img className="album-image"
          src={window.$imageFolder + albumData.image_path}
            alt="album cover"
          />
        </div>
        <div className="al-card-content">
          <div className="al-album-title">{albumData.title}</div>
          <div className="al-album-title">{albumData.artist_name}</div>
        </div>
      </div>
}
    </div>
  );
}
