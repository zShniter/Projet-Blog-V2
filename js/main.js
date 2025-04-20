// main.js - Complete Post System
document.addEventListener('DOMContentLoaded', function() {
    initPostSystem();
    fetchPosts();
});

function initPostSystem() {
    const postBox = document.getElementById('postBox');
    const postContent = document.getElementById('postContent');
    const publishBtn = document.getElementById('publishPostBtn');
    const cancelBtn = document.getElementById('cancelPostBtn');
    const fileInput = document.getElementById('fileInput');
    
    // Event Listeners
    postContent.addEventListener('focus', expandPostBox);
    cancelBtn.addEventListener('click', resetPostBox);
    publishBtn.addEventListener('click', handlePostSubmission);
    
    function expandPostBox() {
        postBox.classList.add('expanded');
    }
    
    function resetPostBox() {
        postBox.classList.remove('expanded');
        document.getElementById('postTitle').value = '';
        postContent.value = '';
        fileInput.value = '';
        document.querySelector('.media-upload-text').textContent = 'Add Image';
    }
    
    async function handlePostSubmission(e) {
        e.preventDefault();
        
        const postTitle = document.getElementById('postTitle').value.trim();
        const postContent = document.getElementById('postContent').value.trim();
        const postCategory = document.getElementById('postCategory').value;
        
        // Validation
        if (!postTitle || !postContent) {
            showAlert('Please fill in both title and content', 'error');
            return;
        }
        
        // Show loading state
        const publishBtn = document.getElementById('publishPostBtn');
        const originalBtnText = publishBtn.innerHTML;
        publishBtn.innerHTML = '<i class="ri-loader-4-line animate-spin"></i> Publishing...';
        publishBtn.disabled = true;
        
        try {
            // Prepare post data
            const postData = {
                title: postTitle,
                content: postContent,
                category: postCategory
            };
            
            // Handle file upload if exists
            if (fileInput.files.length > 0) {
                const uploadResult = await uploadFile(fileInput.files[0]);
                if (uploadResult.success) {
                    postData.image_url = uploadResult.file_path;
                } else {
                    throw new Error(uploadResult.message || 'File upload failed');
                }
            }
            
            // Submit post
            const response = await submitPost(postData);
            
            if (response.success) {
                showAlert('Post published successfully!', 'success');
                resetPostBox();
                fetchPosts();
            } else {
                throw new Error(response.message || 'Failed to create post');
            }
        } catch (error) {
            console.error('Post error:', error);
            showAlert('Error: ' + error.message, 'error');
        } finally {
            publishBtn.innerHTML = originalBtnText;
            publishBtn.disabled = false;
        }
    }
    
    async function uploadFile(file) {
        const formData = new FormData();
        formData.append('image', file);
        
        const response = await fetch('../backend/api/upload.php', {
            method: 'POST',
            body: formData
        });
        
        if (!response.ok) {
            const error = await response.text();
            throw new Error(error);
        }
        
        return await response.json();
    }
    
    async function submitPost(postData) {
        const response = await fetch('../backend/api/posts.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(postData),
            credentials: 'include' // Important for session cookies
        });
        
        if (!response.ok) {
            const error = await response.text();
            throw new Error(error);
        }
        
        return await response.json();
    }
    
    async function fetchPosts() {
        try {
            const response = await fetch('../backend/api/posts.php');
            const data = await response.json();
            
            if (data.data) {
                renderPosts(data.data);
            } else {
                throw new Error(data.message || 'No posts found');
            }
        } catch (error) {
            console.error('Fetch error:', error);
            showAlert('Error loading posts: ' + error.message, 'error');
        }
    }
    
    function renderPosts(posts) {
        const postsContainer = document.getElementById('posts');
        if (!postsContainer) return;
        
        postsContainer.innerHTML = posts.map(post => `
            <div class="post">
                <div class="post-header">
                    <div class="post-author">
                        <img src="../assets/images/user.png" alt="${post.author_name || 'User'}">
                        <div class="post-author-info">
                            <span class="post-author-name">${post.author_name || 'Anonymous'}</span>
                            <span class="post-date">${formatDate(post.created_at)}</span>
                        </div>
                    </div>
                    <div class="post-category">${post.category || 'General'}</div>
                </div>
                
                <div class="post-content">
                    <h3 class="post-title">${post.title || 'Post'}</h3>
                    <p class="post-text">${post.content}</p>
                    
                    ${post.image_url ? `
                        <div class="post-image-container">
                            <img src="../${post.image_url}" alt="${post.title || 'Post image'}" class="post-image">
                        </div>
                    ` : ''}
                </div>
                
                <div class="post-footer">
                    <button class="post-action like-btn">
                        <i class="ri-heart-line"></i>
                        <span>Like</span>
                    </button>
                    <button class="post-action comment-btn">
                        <i class="ri-chat-3-line"></i>
                        <span>Comment</span>
                    </button>
                    <button class="post-action share-btn">
                        <i class="ri-share-line"></i>
                        <span>Share</span>
                    </button>
                </div>
            </div>
        `).join('');
    }
    
    function formatDate(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diff = Math.floor((now - date) / 1000);
        
        if (diff < 60) return 'Just now';
        if (diff < 3600) return `${Math.floor(diff/60)}m ago`;
        if (diff < 86400) return `${Math.floor(diff/3600)}h ago`;
        if (diff < 604800) return `${Math.floor(diff/86400)}d ago`;
        
        return date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    }
    
    function showAlert(message, type = 'error') {
        const alert = document.createElement('div');
        alert.className = `custom-alert ${type}`;
        alert.innerHTML = `
            <i class="${type === 'success' ? 'ri-checkbox-circle-line' : 'ri-error-warning-line'}"></i>
            <span>${message}</span>
        `;
        
        document.body.appendChild(alert);
        
        setTimeout(() => {
            alert.classList.add('show');
        }, 10);
        
        setTimeout(() => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    }
}

// Add dynamic styles
const style = document.createElement('style');
style.textContent = `
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    
    .custom-alert {
        position: fixed;
        top: 2rem;
        right: 2rem;
        padding: 1rem 2rem;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        z-index: 9999;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease;
        max-width: 90%;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .custom-alert.show {
        opacity: 1;
        transform: translateX(0);
    }
    
    .custom-alert.error {
        background-color: #FFEBEE;
        color: #C62828;
        border-left: 4px solid #C62828;
    }
    
    .custom-alert.success {
        background-color: #E8F5E9;
        color: #2E7D32;
        border-left: 4px solid #2E7D32;
    }
    
    .custom-alert i {
        font-size: 1.8rem;
    }
`;
document.head.appendChild(style);