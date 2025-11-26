console.log("js is running");

// Dark/Light mode toggle
const modesbtn = document.getElementById('modesbtn');
modesbtn.addEventListener('click', () => {
    document.body.classList.toggle("dark-mode");
});


// Get elements
const addingbtn = document.getElementById('addingbtn');
const bookmarktitle = document.getElementById('bookmarktitle');
const bookmarkurl = document.getElementById('bookmarkurl');
const bookmarkslist = document.getElementById('bookmarkslist');

// Add bookmark on button click
addingbtn.addEventListener('click', addbookmark);

// Add bookmark on Enter key
bookmarktitle.addEventListener('keypress', e => { if (e.key === 'Enter') addbookmark(); });
bookmarkurl.addEventListener('keypress', e => { if (e.key === 'Enter') addbookmark(); });

function addbookmark() {
    const title = bookmarktitle.value.trim();
    const url = bookmarkurl.value.trim();

    if (title === "" || !url.startsWith("http")) {
        alert("Please enter a valid title and URL starting with http:// or https://");
        return;
    }

    // Create bookmark card
    const listitem = document.createElement('li');
    listitem.classList.add("bookmark-item");

    // Left container: star + link
    const leftContainer = document.createElement("div");
    leftContainer.style.display = "flex";
    leftContainer.style.alignItems = "center";
    leftContainer.style.gap = "10px";

    // Favorite star button
    const fav = document.createElement("button");
    fav.innerHTML = "☆"; // empty star
    fav.classList.add("fav-btn");
    fav.addEventListener("click", () => {
        if (fav.innerHTML === "☆") {
            fav.innerHTML = "★";
            listitem.classList.add("favorite");
        } else {
            fav.innerHTML = "☆";
            listitem.classList.remove("favorite");
        }
    });

    // Link
    const link = document.createElement('a');
    link.href = url;
    link.textContent = title;
    link.target = "_blank";

    // Append star + link to left container
    leftContainer.appendChild(fav);
    leftContainer.appendChild(link);

    // Delete button
    const del = document.createElement("button");
    del.textContent = "🗑️";
    del.classList.add("delete-btn");
    del.addEventListener("click", () => listitem.remove());

    // Append containers to list item
    listitem.appendChild(leftContainer);
    listitem.appendChild(del);

    // Append to bookmarks list
    bookmarkslist.appendChild(listitem);

    // Clear input fields
    bookmarktitle.value = "";
    bookmarkurl.value = "";
}
