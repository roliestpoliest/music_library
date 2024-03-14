import "./App.css";
import React from "react";
import { Link, Route, Routes } from "react-router-dom";
import Home from "./pages/Home/Home";
import About from "./pages/About/About";

function App() {
  return (
    <div>
      <Routes>
        <Route path="/Home" element={<Home />} />
        <Route path="/About" element={<About />} />
      </Routes>

      <div className="App">Hello</div>
      <nav>
        <ul>
          <li>
            <Link to="/home">Home</Link>
          </li>
          <li>
          <Link to="/about">About</Link>
          </li>
        </ul>
      </nav>
    </div>
  );
}

export default App;
