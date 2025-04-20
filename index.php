<?php 
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
	 $logged = true;
	 $user_id = $_SESSION['user_id'];
    }


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hadra.TN | Home</title>
    
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/swiper-bundle.min.css"/>
</head>
<body>
	<?php 
        include 'inc/NavBar.php';
	 ?>
    
    <!-- Featured articles -->
   
    <section class="quick-read section"styles="position">

<div class="container">

    <h2 class="title section-title"id= 'tiiiti' data-name="Quick read">Quick read</h2>
    <!-- Slider main container -->
    <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <a href="blog.php" class="article swiper-slide"id ="article">
                <img src="upload/blog/COVER-64b2da11965537.89753786.png" alt="" class="article-image">

                <div class="article-data-container">
                    <div class="article-data">
                        <span>23 Dec 2021</span>
                        <span class="article-data-spacer"></span>
                        <span>3 Min read</span>
                    </div>
                    <h3 class="title article-title">Sample article title</h3>
                </div>
            </a>
            <!-- Slides -->
            <a href="blog.php" class="article swiper-slide"id ="article">
                <img src="upload/blog/COVER-64b2dd26a7deb9.39821149.png" alt="" class="article-image">

                <div class="article-data-container">
                    <div class="article-data">
                        <span>23 Dec 2021</span>
                        <span class="article-data-spacer"></span>
                        <span>3 Min read</span>
                    </div>
                    <h3 class="title article-title">Sample article title</h3>
                </div>
            </a>
            <!-- Slides -->
            <a href="blog.php" class="article swiper-slide"id ="article">
                <img src="upload/blog/COVER-64baa69b661be3.43596849.jpg" alt="" class="article-image">

                <div class="article-data-container">
                    <div class="article-data">
                        <span>23 Dec 2021</span>
                        <span class="article-data-spacer"></span>
                        <span>3 Min read</span>
                    </div>
                    <h3 class="title article-title">Sample article title</h3>
                </div>
            </a>
            <!-- Slides -->
            <a href="blog.php" class="article swiper-slide"id ="article">
                <img src="upload/blog/COVER-64b2e1f6123915.02720682.jpg" alt="" class="article-image">

                <div class="article-data-container">
                    <div class="article-data">
                        <span>23 Dec 2021</span>
                        <span class="article-data-spacer"></span>
                        <span>3 Min read</span>
                    </div>
                    <h3 class="title article-title">Sample article title</h3>
                </div>
            </a>
            <!-- Slides -->
            <a href="blog.php" class="article swiper-slide"id ="article">
                <img src="upload/blog/COVER-64baa114e66609.40375739.jpg" alt="" class="article-image">

                <div class="article-data-container">
                    <div class="article-data">
                        <span>23 Dec 2021</span>
                        <span class="article-data-spacer"></span>
                        <span>3 Min read</span>
                    </div>
                    <h3 class="title article-title">Sample article title</h3>
                </div>
            </a>
            <!-- Slides -->
            <a href="blog.php" class="article swiper-slide"id ="article">
                <img src="upload/blog/COVER-64ba9e879b0c83.79174008.jpg" alt="" class="article-image">

                <div class="article-data-container">
                    <div class="article-data">
                        <span>23 Dec 2021</span>
                        <span class="article-data-spacer"></span>
                        <span>3 Min read</span>
                    </div>
                    <h3 class="title article-title">Sample article title</h3>
                </div>
            </a>
        </div>
        <!-- Navigation buttons -->
        <div class="swiper-button-prev swiper-controls"></div>
        <div class="swiper-button-next swiper-controls"></div>
        <!-- Pagination -->
        <div class="swiper-pagination"></div>
    </div>

</div>

</section>          



    <!-- Quick read -->
  

    <!-- Categories-->
   

    <!-- Newsletter -->
    <section id="newsletter-section">
    <div class="container">
        <h2 class="title section-title" data-name="Contact Us">Contact Us</h2>

        <div class="form-container-inner">
            <h6 class="title newsletter-title">Report an Issue | Help Us Improve</h6>
            <p class="newsletter-description">Found a bug? Need account help? Let us know!<br>
            We'll review your submission and get back to you soon. Thanks for helping us make our site better!</p>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <form action="php/contact-form.php" method="post" class="form">
                <div class="form-group mb-3">
                    <input type="text" name="name" class="form-input" placeholder="Your Name" required>
                </div>
                <div class="form-group mb-3">
                    <input type="email" name="email" class="form-input" placeholder="Your Email" required>
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="subject" class="form-input" placeholder="Subject" required>
                </div>
                <div class="form-group mb-3">
                    <textarea name="message" class="form-input" placeholder="Your Message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn form-btn">
                    <i class="ri-mail-send-line"></i> Send Message
                </button>
            </form>
        </div>
    </div>
</section>

    <!-- Footer -->
    <footer class="footer section">

        <div class="footer-container container d-grid">
            
            <div class="company-data">
                <a href="./index.html">
                    <h2 class="logo">Hadra.Tn</h2>
                </a>
                <p class="company-description">Your go-to interactive blog for trends, technology, lifestyle, and more. Stay updated and inspired!</p>
                
                <ul class="list social-media">
                    <li class="list-item">
                        <a href="https://www.instagram.com/raween_tozri/?locale=undefined&hl=zh-cn" class="list-link"><i class="ri-instagram-line"></i></a>
                    </li>
                    <li class="list-item">
                        <a href="https://www.facebook.com/rawen.tozri.3" class="list-link"><i class="ri-facebook-circle-line"></i></a>
                    </li>
                    <li class="list-item">
                        <a href="https://x.com/Aly_4real" class="list-link"><i class="ri-twitter-line"></i></a>
                    </li>
                    <li class="list-item">
                        <a href="#" class="list-link"><i class="ri-pinterest-line"></i></a>
                    </li>
                </ul>

                <span class="copyright-notice">&copy;2025 Hadra.Tn. All rights reserved.</span>
            </div>

           

            <div>
                <h6 class="title footer-title">Useful links</h6>
                
                <ul class="footer-list list">
                    <li class="list-item">
                        <a href="index.html" class="list-link">Home</a>
                    </li>
                    
                    <li class="list-item">
                        <a href="#newsletter-section" class="list-link">Contact</a>
                    </li>
                </ul>

            </div>

            <div>
                <h6 class="title footer-title">Company</h6>
                
                <ul class="footer-list list">
                    <li class="list-item">
                        <a href="#" class="list-link">Contact us</a>
                    </li>
                    <li class="list-item">
                        <a href="#" class="list-link">F.A.Q</a>
                    </li>
                    <li class="list-item">
                        <a href="#" class="list-link">Careers</a>
                    </li>
                    <li class="list-item">
                        <a href="#" class="list-link">Authors</a>
                    </li>
                    <li class="list-item">
                        <a href="#" class="list-link">Memberships</a>
                    </li>
                </ul>

            </div>

        </div>
        
    </footer>

    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchPosts();
    });
    
    async function fetchPosts() {
    try {
        const response = await fetch('../backend/api/posts.php');
        if (!response.ok) throw new Error('Failed to fetch posts');
        
        const data = await response.json();
        const postsContainer = document.getElementById('posts');
        
        if (postsContainer) {
            postsContainer.innerHTML = '';
            
            data.data.forEach(post => {
                const postElement = document.createElement('a');
                postElement.className = 'article';
                postElement.href = `post.php?id=${post.id}`;
                
                let imageHtml = '';
                if (post.image_url) {
                    imageHtml = `<img src="../${post.image_url}" alt="${post.title}" class="article-image">`;
                }
                
                postElement.innerHTML = `
                    ${imageHtml}
                    <div class="article-data-container">
                        <div class="article-data">
                            <span>${new Date(post.created_at).toLocaleDateString()}</span>
                            <span class="article-data-spacer"></span>
                            <span>${Math.ceil(post.content.length / 200)} Min read</span>
                        </div>
                        <h3 class="title article-title">${post.title || 'Post'}</h3>
                        <p class="article-description">${post.content.substring(0, 150)}...</p>
                    </div>
                `;
                postsContainer.appendChild(postElement);
            });
        }
    } catch (error) {
        console.error('Error:', error);
        if (postsContainer) {
            postsContainer.innerHTML = '<p>Error loading posts. Please try again later.</p>';
        }
    }
}
    
    async function publishPost() {
    const postContent = document.getElementById('postContent').value;
    const fileInput = document.getElementById('fileInput');
    
    if (!postContent.trim()) {
        alert('Please enter some content for your post');
        return;
    }

    try {
        // First upload image if exists
        let imageUrl = null;
        if (fileInput.files[0]) {
            const formData = new FormData();
            formData.append('image', fileInput.files[0]);
            
            const uploadResponse = await fetch('../backend/api/upload.php', {
                method: 'POST',
                body: formData
            });
            
            const uploadResult = await uploadResponse.json();
            if (!uploadResponse.ok) {
                throw new Error(uploadResult.message || 'Image upload failed');
            }
            imageUrl = uploadResult.file_path;
        }

        // Then create the post
        const response = await fetch('../backend/api/posts.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                title: 'Post', // You might want to extract a title from content
                content: postContent,
                category: 'General', // Default category or get from UI
                image_url: imageUrl
            })
        });

        const result = await response.json();
        
        if (response.ok) {
            alert('Post published successfully!');
            document.getElementById('postContent').value = '';
            fileInput.value = ''; // Clear file input
            fetchPosts(); // Refresh posts
        } else {
            throw new Error(result.message || 'Failed to create post');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error: ' + error.message);
    }
}
    </script>
</body>
</html>