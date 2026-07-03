<article class="team-card">
    <a href="{{ route('experts.show', $expert->slug) }}" class="team-card-media">
        <img src="{{ $expert->photoUrl() }}" alt="{{ $expert->name }}">
        @if ($expert->specialty)
            <span class="team-card-badge">{{ $expert->specialty }}</span>
        @endif
        <span class="team-card-overlay">
            <i class="ri-arrow-right-up-line" aria-hidden="true"></i>
            View Profile
        </span>
    </a>
    <div class="team-card-body">
        <h3 class="team-card-name">{{ $expert->name }}</h3>
        @if ($expert->designation)
            <p class="team-card-role">{{ $expert->designation }}</p>
        @endif
        @if ($expert->experience_label)
            <p class="team-card-experience">
                <i class="ri-award-line" aria-hidden="true"></i>
                {{ $expert->experience_label }}
            </p>
        @endif
        @if ($expert->short_description)
            <p class="team-card-bio">{{ $expert->short_description }}</p>
        @endif
        <a href="{{ route('experts.show', $expert->slug) }}" class="team-card-link">
            View Profile <i class="ri-arrow-right-line" aria-hidden="true"></i>
        </a>
    </div>
</article>
