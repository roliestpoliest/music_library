import { React, useState, useEffect } from "react";
import "./Insert.css";

export default function Subscriptions() {
  return (
    <div>
      <form>
        <h1>Subscription</h1>
        not actual fields
        <div>
          <label>Subscription Type</label>
          <input
            type="text"
            className="Subscriptions"
          />
        </div>
        <div>
          <label>Subscription Length</label>
          <input
            type="text"
            className="Subscriptions"
          />
        </div>
        <div>
          <label>Cost</label>
          <input
            type="text"
            className="Subscriptions"
          />
        </div>
        <button>Submit</button>
      </form>
    </div>
  )
}
