<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Code</title>

    <style>
    :root {
      --bg: #0b1120;
      --card: rgba(255, 255, 255, 0.05);
      --accent: #06b6d4;
      --text: #e2e8f0;
      --muted: #94a3b8;
      --border: rgba(255, 255, 255, 0.08);
      --radius: 14px;
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
      margin: 0;
      min-height: 100vh;
      background: radial-gradient(circle at 30% 20%, #0f172a, #020617);
      color: var(--text);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 32px;
    }

    .wrap {
      width: 100%;
      max-width: 880px;
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      backdrop-filter: blur(18px);
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
      padding: 32px;
      animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(8px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h1 {
      font-size: 22px;
      margin-bottom: 6px;
      font-weight: 600;
      color: var(--accent);
    }

    p.lead {
      color: var(--muted);
      font-size: 14px;
      margin-bottom: 24px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-size: 13px;
      color: var(--muted);
    }

    input, textarea {
      width: 100%;
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      color: var(--text);
      padding: 12px;
      font-family: inherit;
      font-size: 14px;
      transition: all 0.2s ease;
    }

    input:focus, textarea:focus {
      border-color: var(--accent);
      outline: none;
      background: rgba(255, 255, 255, 0.07);
    }

    textarea {
      min-height: 180px;
      resize: vertical;
    }

    .cols {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .controls {
      margin-top: 8px;
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    button {
      background: var(--accent);
      border: none;
      color: #001018;
      font-weight: 600;
      border-radius: var(--radius);
      padding: 10px 16px;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    button:hover {
      background: #22d3ee;
      transform: translateY(-1px);
    }

    button.ghost {
      background: transparent;
      color: var(--accent);
      border: 1px solid var(--border);
    }

    button.ghost:hover {
      background: rgba(255,255,255,0.04);
    }

    .meta {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 13px;
      color: var(--muted);
      margin-top: 4px;
    }

    footer {
      grid-column: 1/-1;
      margin-top: 24px;
      font-size: 13px;
      color: var(--muted);
      border-top: 1px solid var(--border);
      padding-top: 12px;
      text-align: center;
    }

    @media (max-width: 720px) {
      .cols {
        grid-template-columns: 1fr;
      }
    }
  </style>

</head>
<body>
    
</body>
</html>