import Sidebar from "./components/Sidebar/Sidebar";
import Navbar from "./components/Navbar/Navbar";
import MusicPlayer from "./components/MusicPlayer/MusicPlayer";
import AlbumCard from "./components/AlbumCard/AlbumCard";
import "./App.css";

function App() {
  return (
    <div className="App">
      <div className="body">
        <Sidebar />
        <div className="content">
          <Navbar />
          <div className="display">
            rest of website...
            <div className="cards">
              <AlbumCard />
              <AlbumCard />
              <AlbumCard />
              <AlbumCard />
              <AlbumCard />
              <AlbumCard />
            </div>
          </div>
        </div>
      </div>
      <MusicPlayer />
    </div>
  );
}

export default App;
