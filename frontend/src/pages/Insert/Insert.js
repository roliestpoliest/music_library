import React from "react";
import Accounts from "../../components/Forms/Insert/Accounts";
import Events from "../../components/Forms/Insert/Events";
import Genres from "../../components/Forms/Insert/Genres";
import Songs from "../../components/Forms/Insert/Songs";
import Albums from "../../components/Forms/Insert/Albums";
import Playlists from "../../components/Forms/Insert/Playlists";
import Subscriptions from "../../components/Forms/Insert/Subscriptions";
import Transactions from "../../components/Forms/Insert/Transactions";

export default function Insert() {
  return (
    <div>
      <Accounts />
      <hr />
      <Events />
      <hr />
      <Genres />
      <hr />
      <Songs />
      <hr />
      <Albums />
      <hr />
      <Playlists />
      <hr />
      <Subscriptions />
      <hr />
      <Transactions />
    </div>
  );
}
