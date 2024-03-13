import React from 'react'
import './AlbumCard.css'

export default function AlbumCard() {
  return (
    <div className='card'>
        <div className='card-image'>
            <img src='https://storage.googleapis.com/inbox-zero/2880x/saad-chaudhry-G25LeMV7fAw-unsplash.jpg' alt='album cover' />
        </div>
        <div className='card-content'>
            <div className='album-title'>Album Title</div>
            <div className='artist-name'>Artist Name</div>
        </div>
    </div>
  )
}
