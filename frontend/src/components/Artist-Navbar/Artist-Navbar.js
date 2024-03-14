import React from "react";
import "./Navbar.css";
import Button from "@mui/material/Button";
import Menu from "@mui/material/Menu";
import MenuItem from "@mui/material/MenuItem";

export default function Navbar() {
  const [anchorEl, setAnchorEl] = React.useState(null);
  const open = Boolean(anchorEl);
  const handleClick = (event) => {
    setAnchorEl(event.currentTarget);
  };
  const handleClose = () => {
    setAnchorEl(null);
  };

  return (
    <div className="navbar">
      <Button
        id="basic-button"
        aria-controls={open ? "basic-menu" : undefined}
        aria-haspopup="true"
        aria-expanded={open ? "true" : undefined}
        onClick={handleClick}
      >
        <div className="navbar-item">Account</div>
      </Button>
      <Menu
        id="basic-menu"
        anchorEl={anchorEl}
        open={open}
        onClose={handleClose}
        MenuListProps={{
          "aria-labelledby": "basic-button",
        }}
      >
        <MenuItem onClick={handleClose}>Profile</MenuItem>
        <MenuItem onClick={handleClose}>My account</MenuItem>
        <MenuItem onClick={handleClose}>Logout</MenuItem>
        <MenuItem onClick={handleClose}>Discography</MenuItem>
      </Menu>
    </div>
  );
}

// {/* <Button
//   className="navbar-item"
//   id="basic-button"
//   aria-controls={open ? "basic-menu" : undefined}
//   aria-haspopup="true"
//   aria-expanded={open ? "true" : undefined}
//   onClick={handleClick}
// >
//   Premium
// </Button>
// <Menu
//   id="basic-menu"
//   anchorEl={anchorEl}
//   open={open}
//   onClose={handleClose}
//   MenuListProps={{
//     "aria-labelledby": "basic-button",
//   }}
// >
//   <MenuItem onClick={handleClose}>My Subscriptions</MenuItem>
//   <MenuItem onClick={handleClose}>Subscription Plans</MenuItem>
//   <MenuItem onClick={handleClose}>Billing</MenuItem>
// </Menu> */}