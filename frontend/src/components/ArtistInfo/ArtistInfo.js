import React from "react";
import "./ArtistInfo.css";
import Avatar from '@mui/material/Avatar';
import AlbumCard from "../AlbumCard/AlbumCard";
import Rating from '@mui/material/Rating';
import StarIcon from '@mui/icons-material/Star';
import SongCard from "../SongCard/SongCard"



export default function SizeAvatars() {
  const [value, setValue] = React.useState(2);
  return (
    <div className="container">
        <div className="artist">
            <div className="avatar">
                <Avatar
                alt="Remy Sharp"
                src="/static/images/avatar/1.jpg"
                sx={{ width: 246, height: 246 }}
                />
                <h1>Name</h1>
            </div>
            
            <div className="songs">
                <h1>Latest Release</h1>
                <div className="list-songs">
                    <AlbumCard />
                    <SongCard />
                    <AlbumCard />
                </div>
            </div>
            <div className="songs">
                <h1>Popular Songs</h1>
                <div className="list-songs">
                    <SongCard />
                    <SongCard />
                    <SongCard />
                </div>
            </div>
        </div>
        
        <div className="ratings">
            <h1 className="red-text">Artist Ratings</h1>
            <h2 className="red-text">Rate Artist</h2>
            <Rating
            name="simple-controlled"
            value={value}
            size="large"
            emptyIcon={<StarIcon style={{opacity:0.10}} fontsize='inherit'/>}
            onChange={(event, newValue) => {
            setValue(newValue);
            }}
            />
            <h1 className="red-text">Events</h1>
        </div>
    </div>
    
  );
}
