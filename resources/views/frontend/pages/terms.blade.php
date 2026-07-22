@extends('frontend.layouts.app')

@section('title', 'Terms & Conditions')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Terms & Conditions</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Terms & Conditions Section -->
    <section class="terms-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="fw-bold mb-4">Terms & Conditions</h2>
                    <p class="text-muted mb-4">Last updated: November 11, 2025</p>

                    <h4>1. Introduction</h4>
                    <p>Welcome to FreshMart. These Terms and Conditions govern your use of our website and services. By
                        accessing or using our website, you agree to be bound by these terms.</p>

                    <h4>2. Use of Service</h4>
                    <p>You must be at least 18 years old to use our service. You are responsible for maintaining the
                        confidentiality of your account and password. You agree to accept responsibility for all activities
                        that occur under your account.</p>
                    <p>FreshMart reserves the right to refuse service, terminate accounts, or cancel orders at our sole
                        discretion.</p>

                    <h4>3. Products and Pricing</h4>
                    <p>We strive to provide accurate product descriptions and pricing. However, we do not warrant that
                        product descriptions, pricing, or other content is accurate, complete, reliable, current, or
                        error-free.</p>
                    <p>We reserve the right to modify prices at any time without prior notice. In the event of a pricing
                        error, we reserve the right to cancel any orders placed at the incorrect price.</p>

                    <h4>4. Orders and Payment</h4>
                    <p>By placing an order, you make an offer to purchase products at the price indicated. We reserve the
                        right to accept or decline your order for any reason.</p>
                    <p>Payment must be received by us before your order is processed. We accept various payment methods
                        including credit cards, debit cards, and online payment systems.</p>
                    <p>All payments are processed securely through our payment gateway partners.</p>

                    <h4>5. Delivery</h4>
                    <p>We aim to deliver products within the estimated delivery time. However, delivery times are not
                        guaranteed and may vary due to circumstances beyond our control.</p>
                    <p>Risk of loss and title for products purchased pass to you upon delivery. You must be available to
                        accept delivery at the address provided.</p>

                    <h4>6. Returns and Refunds</h4>
                    <p>Due to the perishable nature of our products, we have specific return and refund policies. Products
                        can be returned within 24 hours of delivery if they are damaged or not as described.</p>
                    <p>Refunds will be processed within 7-10 business days after we receive and inspect the returned
                        products. Please contact our customer service for return authorization.</p>

                    <h4>7. Intellectual Property</h4>
                    <p>All content on this website, including text, graphics, logos, images, and software, is the property
                        of FreshMart and is protected by copyright and trademark laws.</p>
                    <p>You may not reproduce, distribute, or create derivative works from any content without our express
                        written permission.</p>

                    <h4>8. Limitation of Liability</h4>
                    <p>FreshMart shall not be liable for any indirect, incidental, special, consequential, or punitive
                        damages resulting from your use of or inability to use the service.</p>
                    <p>Our total liability to you for any damages shall not exceed the amount paid by you for the products
                        purchased.</p>

                    <h4>9. Privacy</h4>
                    <p>Your use of our website is also governed by our <a href="privacy.html" class="text-success">Privacy
                            Policy</a>. Please review our Privacy Policy to understand our practices.</p>

                    <h4>10. Changes to Terms</h4>
                    <p>We reserve the right to modify these Terms and Conditions at any time. Changes will be effective
                        immediately upon posting to the website. Your continued use of the service after changes are posted
                        constitutes your acceptance of the modified terms.</p>

                    <h4>11. Contact Information</h4>
                    <p>If you have any questions about these Terms and Conditions, please contact us:</p>
                    <p>
                        Email: support@freshmart.com<br>
                        Phone: +1 234 567 8900<br>
                        Address: 123 Market Street, City, State 12345
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection