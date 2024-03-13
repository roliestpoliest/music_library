import React from "react";
import "./MusicPlayer.css";
import MusicControls from "./MusicControls/MusicControls";
import CurrentlyPlaying from "./CurrentlyPlaying/CurrentlyPlaying";

export default function MusicPlayer() {
  return (
    <div className="MusicPlayer">
      <div>
        <CurrentlyPlaying />
      </div>
      <div>
        <MusicControls />
      </div>
      <div>Component Here</div>
    </div>
  );
}
