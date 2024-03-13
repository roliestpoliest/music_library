import Sidebar from "./components/Sidebar/Sidebar";
import Navbar from "./components/Navbar/Navbar";
import MusicPlayer from "./components/MusicPlayer/MusicPlayer";
import "./App.css";

function App() {
  return (
    <div className="App">
      <div className="body">
        <Sidebar />
        <div className="content">
          <Navbar />
          <div className="display">rest of website...</div>
        </div>
      </div>
      <MusicPlayer />
    </div>
  );
}

export default App;
