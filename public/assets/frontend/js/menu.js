document.querySelector('.wishlist-container').addEventListener('mouseover', function() {
    // Add dynamic content loading here if needed
    document.querySelector('.wishlist-content').style.display = 'block';
});

document.querySelector('.wishlist-container').addEventListener('mouseout', function() {
    document.querySelector('.wishlist-content').style.display = 'none';
});

document.querySelector('.cartlist-container').addEventListener('mouseover', function() {
    // Add dynamic content loading here if needed
    document.querySelector('.cartlist-content').style.display = 'block';
});

document.querySelector('.cartlist-container').addEventListener('mouseout', function() {
    document.querySelector('.cartlist-content').style.display = 'none';
});
