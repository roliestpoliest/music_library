import "./App.css";
import React from "react";
import { Route, Routes } from "react-router-dom";
import Home from "./pages/Home/Home";
import About from "./pages/About/About";
import ArtistAbout from "./pages/ArtistAbout/ArtistAbout";
import ArtistHome from "./pages/ArtistHome/ArtistHome";
import CreateUser from "./pages/CreateUser/CreateUser";
import Login from "./pages/Login/Login";


function App() {
  return (
    <div>
      <Routes>
        <Route path="/Home" element={<Home />} />
        <Route path="/About" element={<About />} />
        <Route path="/ArtistAbout" element={<ArtistAbout />} />
        <Route path="/ArtistHome" element={<ArtistHome />} />
        <Route path="/CreateUser" element={<CreateUser />} />
        <Route path="/Login" element={<Login />} />
      </Routes>
    </div>
  );
}

export default App;
