import React from "react";
import "./Sidebar.css";
import List from "@mui/material/List";
import ListItem from "@mui/material/ListItem";
import ListItemButton from "@mui/material/ListItemButton";
import ListItemText from "@mui/material/ListItemText";
import ListItemIcon from "@mui/material/ListItemIcon";
import PlayCircleFilledWhiteOutlinedIcon from '@mui/icons-material/PlayCircleFilledWhiteOutlined';
import GridViewOutlinedIcon from '@mui/icons-material/GridViewOutlined';
import RecordVoiceOverIcon from '@mui/icons-material/RecordVoiceOver';
import MusicNoteIcon from '@mui/icons-material/MusicNote';
import AlbumIcon from '@mui/icons-material/Album';
import QueueMusicIcon from '@mui/icons-material/QueueMusic';
import AddIcon from '@mui/icons-material/Add';

export default function Navbar() {
  return (
    <div className="sidebar">
      <div className="span">
        <div className="header">Discover</div>
        <div className="content">
          <List>
            <ListItem disablePadding>
              <ListItemButton>
                <ListItemIcon>
                  <PlayCircleFilledWhiteOutlinedIcon className="white-icon" />
                </ListItemIcon>
                <ListItemText primary="Listen Now" />
              </ListItemButton>
            </ListItem>

            <ListItem disablePadding>
              <ListItemButton>
                <ListItemIcon>
                  <GridViewOutlinedIcon className="white-icon" />
                </ListItemIcon>
                <ListItemText primary="Browse" />
              </ListItemButton>
            </ListItem>
          </List>
        </div>

        <div className="header">Library</div>
        <div className="content">
          <ListItem disablePadding>
            <ListItemButton>
              <ListItemIcon>
                <RecordVoiceOverIcon className="white-icon" />
              </ListItemIcon>
              <ListItemText primary="Followed Artists" />
            </ListItemButton>
          </ListItem>

          <ListItem disablePadding>
            <ListItemButton>
              <ListItemIcon>
                <AlbumIcon className="white-icon" />
              </ListItemIcon>
              <ListItemText primary="Rated Albums" />
            </ListItemButton>
          </ListItem>

          <ListItem disablePadding>
            <ListItemButton>
              <ListItemIcon>
                <MusicNoteIcon className="white-icon" />
              </ListItemIcon>
              <ListItemText primary="Rated Songs" />
            </ListItemButton>
          </ListItem>
        </div>

        <div className="header">Playlists</div>
        <div className="content">
          <ListItem disablePadding>
            <ListItemButton>
              <ListItemIcon>
                <QueueMusicIcon className="white-icon" />
              </ListItemIcon>
              <ListItemText primary="Liked Songs" />
            </ListItemButton>
          </ListItem>
          
          <ListItem disablePadding>
            <ListItemButton>
              <ListItemIcon>
                <AddIcon className="white-icon" />
              </ListItemIcon>
              <ListItemText primary="Create Playlist" />
            </ListItemButton>
          </ListItem>
        </div>
      </div>
    </div>
  );
}
