import "./Home.css";
import Sidebar from "../../components/Sidebar/Sidebar";
import Navbar from "../../components/Navbar/Navbar";
import MusicPlayer from "../../components/MusicPlayer/MusicPlayer";
import AlbumCard from "../../components/AlbumCard/AlbumCard";
import ArtistCard from "../../components/ArtistCard/ArtistCard";

export default function Home() {
  return (
    <div className="Home">
      <div className="body">
        <Sidebar />
        <div className="content">
          <Navbar />
          <div className="display">

            {/* <ScrollArea.Root>
              <ScrollArea.Viewport>
                <div>
                  Your content here
                  <div className="cards">
                    <AlbumCard />
                    <AlbumCard />
                    <AlbumCard />
                    <AlbumCard />
                    <AlbumCard />
                    <AlbumCard />
                    <ArtistCard />
                  </div>
                </div>
              </ScrollArea.Viewport>
              <ScrollArea.Scrollbar orientation="vertical">
                <ScrollArea.Thumb />
              </ScrollArea.Scrollbar>
              <ScrollArea.Scrollbar>
                <ScrollArea.Thumb />
              </ScrollArea.Scrollbar>
              <ScrollArea.Corner />
            </ScrollArea.Root> */}

            <div className="cards">
              <AlbumCard />
              <AlbumCard />
              <AlbumCard />
              <ArtistCard />
              <ArtistCard />
            </div>
          </div>
        </div>
      </div>
      <MusicPlayer />
    </div>
  );
}
