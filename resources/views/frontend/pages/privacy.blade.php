@extends('frontend.layouts.app')

@section('title', 'Privacy & Policy')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Privacy Policy Section -->
    <section class="privacy-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="fw-bold mb-4">Privacy Policy</h2>
                    <p class="text-muted mb-4">Last updated: November 11, 2025</p>

                    <h4>1. Information We Collect</h4>
                    <p>We collect information that you provide directly to us, including:</p>
                    <ul>
                        <li>Personal information (name, email address, phone number, shipping address)</li>
                        <li>Payment information (credit card details, billing address)</li>
                        <li>Account credentials (username, password)</li>
                        <li>Order history and preferences</li>
                        <li>Communications with our customer service team</li>
                    </ul>
                    <p>We also automatically collect certain information when you visit our website, such as IP address,
                        browser type, device information, and browsing behavior.</p>

                    <h4>2. How We Use Your Information</h4>
                    <p>We use the information we collect to:</p>
                    <ul>
                        <li>Process and fulfill your orders</li>
                        <li>Communicate with you about your orders and account</li>
                        <li>Provide customer support</li>
                        <li>Send you marketing communications (with your consent)</li>
                        <li>Improve our website and services</li>
                        <li>Prevent fraud and enhance security</li>
                        <li>Comply with legal obligations</li>
                    </ul>

                    <h4>3. Information Sharing</h4>
                    <p>We do not sell your personal information. We may share your information with:</p>
                    <ul>
                        <li><strong>Service Providers:</strong> Third-party vendors who help us operate our business
                            (payment processors, delivery services, hosting providers)</li>
                        <li><strong>Legal Requirements:</strong> When required by law or to protect our rights</li>
                        <li><strong>Business Transfers:</strong> In connection with a merger, acquisition, or sale of assets
                        </li>
                    </ul>
                    <p>All third-party service providers are required to maintain the confidentiality of your information.
                    </p>

                    <h4>4. Cookies and Tracking</h4>
                    <p>We use cookies and similar tracking technologies to enhance your experience on our website. Cookies
                        help us:</p>
                    <ul>
                        <li>Remember your preferences and settings</li>
                        <li>Keep you logged in</li>
                        <li>Understand how you use our website</li>
                        <li>Show you relevant advertisements</li>
                    </ul>
                    <p>You can control cookies through your browser settings. However, disabling cookies may affect your
                        ability to use certain features of our website.</p>

                    <h4>5. Data Security</h4>
                    <p>We implement appropriate technical and organizational measures to protect your personal information
                        against unauthorized access, alteration, disclosure, or destruction.</p>
                    <p>However, no method of transmission over the internet is 100% secure. While we strive to protect your
                        information, we cannot guarantee its absolute security.</p>

                    <h4>6. Your Rights</h4>
                    <p>You have the right to:</p>
                    <ul>
                        <li>Access your personal information</li>
                        <li>Correct inaccurate information</li>
                        <li>Request deletion of your information</li>
                        <li>Opt-out of marketing communications</li>
                        <li>Restrict processing of your information</li>
                        <li>Data portability</li>
                    </ul>
                    <p>To exercise these rights, please contact us using the information provided below.</p>

                    <h4>7. Children's Privacy</h4>
                    <p>Our services are not directed to children under 18. We do not knowingly collect personal information
                        from children. If you believe we have collected information from a child, please contact us
                        immediately.</p>

                    <h4>8. Third-Party Links</h4>
                    <p>Our website may contain links to third-party websites. We are not responsible for the privacy
                        practices of these websites. We encourage you to review their privacy policies before providing any
                        information.</p>

                    <h4>9. Changes to Privacy Policy</h4>
                    <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the
                        new policy on this page with an updated "Last updated" date. Your continued use of our services
                        after changes constitutes acceptance of the updated policy.</p>

                    <h4>10. Contact Us</h4>
                    <p>If you have any questions about this Privacy Policy or our data practices, please contact us:</p>
                    <ul>
                        <li>Email: privacy@freshmart.com</li>
                        <li>Phone: +1 234 567 8900</li>
                        <li>Address: 123 Market Street, City, State 12345</li>
                    </ul>

                </div>
            </div>
        </div>
    </section>
@endsection