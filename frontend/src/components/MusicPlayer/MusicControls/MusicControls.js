import React, { useState } from "react";
import "./MusicControls.css";
import SkipNextIcon from "@mui/icons-material/SkipNext";
import SkipPreviousIcon from "@mui/icons-material/SkipPrevious";
import PlayArrowIcon from "@mui/icons-material/PlayArrow";
import PauseIcon from "@mui/icons-material/Pause";


function MusicControls() {
  const [isPlaying, setIsPlaying] = useState(false);

  const handleClick = () => {
    setIsPlaying(!isPlaying);
  };

  return (
    <div className="MusicControls">
      <SkipPreviousIcon className="MusicIcon" />
      <div onClick={handleClick}>
        {isPlaying ? (
          <PauseIcon className="MusicIcon" />
        ) : (
          <PlayArrowIcon className="MusicIcon" />
        )}
      </div>
      <SkipNextIcon className="MusicIcon" />
    </div>
  );
}

export default MusicControls;
