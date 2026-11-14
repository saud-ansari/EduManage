@extends('layouts.app')

@section('title', 'Contact')

@section('heading', 'Contact Us')

@section('content')

    <div class="row g-4">

        <div class="col-md-5">

            <div class="content-card h-100">

                <h4 class="fw-bold mb-3">
                    Get In Touch
                </h4>

                <p class="text-muted">
                    Contact our institute for information
                    about courses and student services.
                </p>

                <hr>

                <p>
                    <i class="bi bi-envelope text-primary me-2"></i>
                    info@example.com
                </p>

                <p>
                    <i class="bi bi-telephone text-primary me-2"></i>
                    9876543210
                </p>

                <p>
                    <i class="bi bi-geo-alt text-primary me-2"></i>
                    Mumbai, Maharashtra
                </p>

            </div>

        </div>

        <div class="col-md-7">

            <div class="content-card">

                <h5 class="fw-bold mb-3">
                    Send an Enquiry
                </h5>

                <form>

                    <div class="mb-3">

                        <label class="form-label">
                            Your Name
                        </label>

                        <input type="text"
                               class="form-control"
                               placeholder="Enter your name">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Email Address
                        </label>

                        <input type="email"
                               class="form-control"
                               placeholder="Enter your email">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Message
                        </label>

                        <textarea class="form-control"
                                  rows="4"
                                  placeholder="Enter your message">
                        </textarea>

                    </div>

                    <button type="button"
                            class="btn btn-primary"
                            disabled>

                        Send Enquiry

                    </button>

                    <small class="d-block text-muted mt-2">
                        Enquiry submission will be implemented
                        in a later lesson.
                    </small>

                </form>

            </div>

        </div>

    </div>

@endsection

