import "./ArtistAbout.css";
import Sidebar from "./components/Sidebar/Sidebar";
import Navbar from "./components/Navbar/Navbar";
import MusicPlayer from "./components/MusicPlayer/MusicPlayer";
import AlbumCard from "./components/AlbumCard/AlbumCard";
import ArtistCard from "./components/ArtistCard/ArtistCard";

function App() {
  return (
    <div className="App">
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

export default App;
