<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>API Summary</title>
    <style>
        :root { color-scheme: light dark; }
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background: #0f172a; color: #f8fafc; min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 24px; }
        .card { width: min(960px, 100%); background: rgba(15, 23, 42, 0.75); border-radius: 16px; border: 1px solid rgba(148, 163, 184, 0.25); padding: 32px; backdrop-filter: blur(16px); box-shadow: 0 30px 60px rgba(15, 23, 42, 0.6); }
        .card h1 { margin: 0 0 24px; font-size: 32px; letter-spacing: 0.12em; text-transform: uppercase; color: #38bdf8; }
        .grid { display: grid; gap: 16px; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); margin-bottom: 32px; }
        .metric { padding: 20px; border-radius: 12px; background: rgba(30, 41, 59, 0.85); border: 1px solid rgba(148, 163, 184, 0.25); text-align: center; }
        .metric span { display: block; font-size: 42px; font-weight: 700; color: #fbbf24; }
        .metric label { display: block; font-size: 13px; letter-spacing: 0.2em; text-transform: uppercase; margin-top: 8px; color: #94a3b8; }
        h2 { margin: 0 0 16px; font-size: 20px; letter-spacing: 0.08em; text-transform: uppercase; color: #38bdf8; }
        .post { padding: 16px; border-radius: 12px; background: rgba(30, 41, 59, 0.7); border: 1px solid rgba(148, 163, 184, 0.18); }
        .post h3 { margin: 0 0 8px; font-size: 18px; color: #f8fafc; }
        .post p { margin: 0 0 12px; color: #cbd5f5; line-height: 1.5; }
        .post small { color: #64748b; letter-spacing: 0.08em; text-transform: uppercase; }
        @media (max-width: 640px) { .card { padding: 20px; } .metric span { font-size: 32px; } }
    </style>
</head>
<body>
    <section class="card">
        <h1>API Dashboard</h1>
        <div class="grid">
            <div class="metric"><span>{{ number_format($usersCount) }}</span><label>Users</label></div>
            <div class="metric"><span>{{ number_format($incidentTypesCount) }}</span><label>Incident Types</label></div>
            <div class="metric"><span>{{ number_format($incidentsCount) }}</span><label>Incidents</label></div>
            <div class="metric"><span>{{ number_format($postsCount) }}</span><label>Posts</label></div>
        </div>
        <h2>Latest Posts</h2>
        @forelse ($latestPosts as $post)
            <article class="post">
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->content }}</p>
                <small>Created {{ $post->created_at->diffForHumans() }}</small>
            </article>
        @empty
            <article class="post">
                <h3>No posts yet</h3>
                <p>Create a post via the API and refresh to see it here.</p>
                <small>Waiting for first entry</small>
            </article>
        @endforelse

        <h2>Latest Registered Users</h2>
        @forelse ($latestUsers as $user)
            <article class="post">
                <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
                <p>
                    Email: {{ $user->email }}<br>
                    Mobile: {{ $user->mobile_number }}<br>
                    Role: {{ ucfirst($user->role) }}
                </p>
                <small>Registered {{ $user->created_at->diffForHumans() }}</small>
            </article>
        @empty
            <article class="post">
                <h3>No users yet</h3>
                <p>Register a user via the API and refresh to see them here.</p>
                <small>Waiting for first registration</small>
            </article>
        @endforelse
    </section>
</body>
</html>
