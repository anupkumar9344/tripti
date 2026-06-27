@extends('admin.layouts.app')

@section('title', 'Blog Posts')

@push('styles')
    <link href="{{ asset('admin/assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/admin-datatable.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <a href="{{ route('admin.blog-posts.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Add Post
                    </a>
                </div>
                <h4 class="page-title">Blog Posts</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">All Posts</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive admin-datatable">
                        <table class="table table-striped table-bordered mb-0" id="datatable_blog_posts">
                            <thead class="thead-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Post</th>
                                    <th>Home</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->formattedDate() ?: '—' }}</td>
                                        <td>
                                            <img src="{{ $post->featuredImageUrl() }}" alt="{{ $post->title }}" height="40" class="rounded me-2">
                                            <span class="d-inline-block align-middle">
                                                <span class="fw-semibold d-block">{{ $post->title }}</span>
                                                <span class="font-12 text-muted">{{ $post->author ?: '—' }}</span>
                                            </span>
                                        </td>
                                        <td>
                                            @if ($post->display_on_home)
                                                <span class="badge badge-soft-success">Yes</span>
                                            @else
                                                <span class="badge badge-soft-secondary">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($post->status)
                                                <span class="badge badge-soft-success">Published</span>
                                            @else
                                                <span class="badge badge-soft-danger">Draft</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('blog.show', $post->slug) }}" class="me-2" title="View" target="_blank">
                                                <i class="las la-eye text-secondary font-16"></i>
                                            </a>
                                            <a href="{{ route('admin.blog-posts.edit', $post) }}" class="me-2" title="Edit">
                                                <i class="las la-pen text-secondary font-16"></i>
                                            </a>
                                            <form action="{{ route('admin.blog-posts.destroy', $post) }}" method="POST" class="d-inline js-confirm-delete" data-title="Delete post?" data-text="This blog post will be removed from the website.">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0 border-0" title="Delete">
                                                    <i class="las la-trash-alt text-secondary font-16"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/datatables/simple-datatables.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.querySelector('#datatable_blog_posts');

            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 10,
                    perPageSelect: [10, 25, 50, 100],
                    labels: {
                        placeholder: 'Search posts...',
                        noRows: 'No blog posts found.',
                        noResults: 'No matching posts found.',
                    },
                });
            }
        });
    </script>
@endpush
