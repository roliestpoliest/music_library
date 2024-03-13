import React from 'react'
import './CurrentlyPlaying.css'

export default function CurrentlyPlaying() {
  return (
    <div className="container">
      <img className="display-image"
          src="https://storage.googleapis.com/inbox-zero/2880x/saad-chaudhry-G25LeMV7fAw-unsplash.jpg"
          alt="album cover"
        />
        <div className="display-content">
            <div className="display-title">Album Title</div>
            <div className="display-name">Artist Name</div>
        </div>
    </div>
  )
}
