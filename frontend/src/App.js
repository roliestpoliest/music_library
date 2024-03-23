import "./App.css";
import React from "react";
import { Link,Route, Routes } from "react-router-dom";
import Home from "./pages/Home/Home";
import About from "./pages/About/About";
import ArtistAbout from "./pages/ArtistAbout/ArtistAbout";
import ArtistHome from "./pages/ArtistHome/ArtistHome";
import SignUp from "./pages/SignUp/SignUp";
import Login from "./pages/Login/Login";
import Insert from "./pages/Insert/Insert";
import Modify from "./pages/Modify/Modify";
import CreateUser from './components/CreateUser/CreateUser';

function App() {
  return (
    <div>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/About" element={<About />} />
        <Route path="/ArtistAbout" element={<ArtistAbout />} />
        <Route path="/ArtistHome" element={<ArtistHome />} />
        <Route path="/SignUp" element={<SignUp />} />
        <Route path="/Login" element={<Login />} />
        <Route path="/Insert" element={<Insert />} />
        <Route path="/Modify" element={<Modify />} />
        <Route path="/CreateUser" element={<CreateUser />} />
      </Routes>
      <nav>
        <ul>
          <li>
            <Link to="/">Home</Link>
          </li>
          <li>
            <Link to="/About">About</Link>
          </li>
          <li>
            <Link to="/ArtistAbout">Artist About</Link>
          </li>
          <li>
            <Link to="/ArtistHome">Artist Home</Link>
          </li>
          <li>
            <Link to="/CreateUser">Create User</Link>
          </li>
          <li>
            <Link to="/Login">Login</Link>
          </li>
          <li>
            <Link to="/Insert">Insert</Link>
          </li>
          <li>
            <Link to="/Modify">Modify</Link>
          </li>
        </ul>
      </nav>
    </div>
  );
}

export default App;
