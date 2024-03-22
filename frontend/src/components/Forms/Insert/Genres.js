import { React, useState, useEffect } from "react";
import "./Insert.css";
import axios from "axios";

export default function Genres() {
  const [title, setTitle] = useState();

  const [complete, setComplete] = useState(false);

  return (
    <div>
      <form>
        <h1>Genre</h1>
        <div>
          <label>Title</label>
          <input
            type="text"
            className="Genres"
            onChange={(e) => setTitle(e.target.value)}
          />
        </div>
        <button>Submit</button>
      </form>
    </div>
  )
}
