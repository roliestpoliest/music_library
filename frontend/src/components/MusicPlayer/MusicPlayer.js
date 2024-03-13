import React from "react";
import "./MusicPlayer.css";
import MusicControls from "./MusicControls/MusicControls";

export default function MusicPlayer() {
  return (
    <div className="MusicPlayer">
      <div>Music Here</div>
      <div>
        <MusicControls />
      </div>
      <div>Audio Here</div>
    </div>
  );
}
