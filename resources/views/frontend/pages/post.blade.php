@extends('frontend.layouts.app')

@section('title', 'Post')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('blog') }}" class="text-success">Blog</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Post</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Blog Post Section -->
    <section class="post-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Post Header -->
                    <div class="mb-4">
                        <h1 class="fw-bold mb-3">10 Benefits of Eating Fresh Fruits Daily</h1>
                        <div class="text-muted mb-4">
                            <span><i class="bi bi-calendar3"></i> November 10, 2025</span>
                            <span class="ms-3"><i class="bi bi-chat-dots"></i> 15 Comments</span>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <img src="{{ asset('dist-frontend/images/post1.jpg') }}" alt="Blog Post" class="mb-4 blog-post-detail">

                    <!-- Post Content -->
                    <div class="post-content">
                        <p class="lead">Fresh fruits are nature's perfect snack - packed with vitamins, minerals, and
                            antioxidants that can transform your health and wellbeing.</p>

                        <p>Incorporating fresh fruits into your daily diet is one of the simplest yet most effective ways to
                            improve your overall health. Not only are they delicious and convenient, but they also provide
                            essential nutrients that your body needs to function optimally.</p>

                        <h3 class="fw-bold mt-4 mb-3">1. Boosts Immune System</h3>
                        <p>Fresh fruits are rich in vitamin C and other antioxidants that help strengthen your immune
                            system, protecting you from common illnesses and infections.</p>

                        <h3 class="fw-bold mt-4 mb-3">2. Improves Digestion</h3>
                        <p>The high fiber content in fruits aids digestion and helps maintain a healthy gut. Regular
                            consumption can prevent constipation and promote regular bowel movements.</p>

                        <h3 class="fw-bold mt-4 mb-3">3. Natural Energy Source</h3>
                        <p>Fruits contain natural sugars that provide quick energy without the crash associated with
                            processed sugars. They're perfect for a pre-workout snack or mid-afternoon pick-me-up.</p>

                        <h3 class="fw-bold mt-4 mb-3">4. Supports Weight Management</h3>
                        <p>Low in calories and high in fiber, fruits can help you feel full longer, making them an excellent
                            choice for weight management and healthy snacking.</p>

                        <h3 class="fw-bold mt-4 mb-3">5. Promotes Healthy Skin</h3>
                        <p>The vitamins and antioxidants in fruits contribute to glowing, healthy skin by fighting free
                            radicals and promoting collagen production.</p>

                        <h3 class="fw-bold mt-4 mb-3">Conclusion</h3>
                        <p>Making fresh fruits a daily habit is a simple step toward better health. Start small by adding
                            one or two servings to your daily routine and gradually increase your intake. Your body will
                            thank you!</p>
                    </div>

                    <!-- Post Footer -->
                    <div class="border-top border-bottom py-4 my-5">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Tags:</strong>
                                <a href="#" class="badge bg-light text-dark ms-2">Healthy Eating</a>
                                <a href="#" class="badge bg-light text-dark ms-1">Fruits</a>
                                <a href="#" class="badge bg-light text-dark ms-1">Nutrition</a>
                            </div>
                            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                <strong>Share:</strong>
                                <a href="#" class="btn btn-sm btn-outline-success ms-2"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-success ms-1"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-success ms-1"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="comments-section mt-5">
                        <h3 class="fw-bold mb-4">Comments (5)</h3>

                        <!-- Comment 1 - Parent -->
                        <div class="comment mb-4 p-4 bg-light rounded">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex">
                                    <div class="shrink-0">
                                        <div
                                            class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center avatar-circle-sm">
                                            <i class="bi bi-person-fill text-success fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-1 fw-bold">John Smith</h6>
                                        <small class="text-muted">November 11, 2025 at 10:30 AM</small>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-outline-success reply-btn" data-comment-id="1">
                                    <i class="bi bi-reply"></i> Reply
                                </button>
                            </div>
                            <p class="mb-0">Great article! I've been trying to eat more fruits daily and I can already feel
                                the difference in my energy levels. Thanks for sharing these valuable insights.</p>

                            <!-- Child Comment -->
                            <div class="child-comment mt-3 ms-5 p-3 bg-white rounded border">
                                <div class="d-flex mb-2">
                                    <div class="shrink-0">
                                        <div
                                            class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center avatar-circle-xs">
                                            <i class="bi bi-person-fill text-success fs-6"></i>
                                        </div>
                                    </div>
                                    <div class="grow ms-3">
                                        <h6 class="mb-1 fw-bold">Admin</h6>
                                        <small class="text-muted">November 11, 2025 at 11:15 AM</small>
                                    </div>
                                </div>
                                <p class="mb-0">Thank you, John! We're glad you found the article helpful. Keep up the
                                    healthy habits!</p>
                            </div>
                        </div>

                        <!-- Comment 2 - Parent -->
                        <div class="comment mb-4 p-4 bg-light rounded">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex">
                                    <div class="shrink-0">
                                        <div
                                            class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center avatar-circle-sm">
                                            <i class="bi bi-person-fill text-success fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-1 fw-bold">Sarah Johnson</h6>
                                        <small class="text-muted">November 10, 2025 at 3:45 PM</small>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-outline-success reply-btn" data-comment-id="2">
                                    <i class="bi bi-reply"></i> Reply
                                </button>
                            </div>
                            <p class="mb-0">I love this! Do you have any recommendations for fruits that are good for weight
                                loss?</p>

                            <!-- Child Comment -->
                            <div class="child-comment mt-3 ms-5 p-3 bg-white rounded border">
                                <div class="d-flex mb-2">
                                    <div class="shrink-0">
                                        <div
                                            class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center avatar-circle-xs">
                                            <i class="bi bi-person-fill text-success fs-6"></i>
                                        </div>
                                    </div>
                                    <div class="grow ms-3">
                                        <h6 class="mb-1 fw-bold">Admin</h6>
                                        <small class="text-muted">November 10, 2025 at 5:20 PM</small>
                                    </div>
                                </div>
                                <p class="mb-0">Great question, Sarah! Berries, apples, and grapefruit are excellent choices
                                    for weight management. They're low in calories and high in fiber.</p>
                            </div>
                        </div>

                        <!-- Comment 3 - Parent without replies -->
                        <div class="comment mb-4 p-4 bg-light rounded">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex">
                                    <div class="shrink-0">
                                        <div
                                            class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center avatar-circle-sm">
                                            <i class="bi bi-person-fill text-success fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-1 fw-bold">Michael Brown</h6>
                                        <small class="text-muted">November 10, 2025 at 9:00 AM</small>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-outline-success reply-btn" data-comment-id="3">
                                    <i class="bi bi-reply"></i> Reply
                                </button>
                            </div>
                            <p class="mb-0">Very informative post. I'm going to start adding more variety to my fruit
                                intake.</p>
                        </div>

                        <!-- Leave a Comment Form -->
                        <div class="leave-comment mt-5">
                            <h4 class="fw-bold mb-4">Leave a Comment</h4>
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Your Name *" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" placeholder="Your Email *" required>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control" rows="5" placeholder="Your Comment *"
                                            required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-send me-2"></i>Post Comment
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Reply Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="replyModalLabel">Reply to Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="replyForm">
                        <div class="mb-3">
                            <label class="form-label">Your Name *</label>
                            <input type="text" class="form-control" id="replyName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Your Email *</label>
                            <input type="email" class="form-control" id="replyEmail" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Your Reply *</label>
                            <textarea class="form-control" id="replyMessage" rows="4" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="submitReply">
                        <i class="bi bi-send me-2"></i>Submit Reply
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Reply button functionality
        document.addEventListener('DOMContentLoaded', function () {
            const replyButtons = document.querySelectorAll('.reply-btn');
            const replyModal = new bootstrap.Modal(document.getElementById('replyModal'));

            replyButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const commentId = this.getAttribute('data-comment-id');
                    replyModal.show();
                });
            });

            // Submit reply
            document.getElementById('submitReply').addEventListener('click', function () {
                const name = document.getElementById('replyName').value;
                const email = document.getElementById('replyEmail').value;
                const message = document.getElementById('replyMessage').value;

                if (name && email && message) {
                    // Here you would normally send the reply to your server
                    alert('Reply submitted successfully!');
                    replyModal.hide();
                    document.getElementById('replyForm').reset();
                }
            });
        });
    </script>
@endpush