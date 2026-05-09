<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do API Docs</title>
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@5/swagger-ui.css">
    <style>
        html,
        body {
            margin: 0;
            background: #fafafa;
        }

        #swagger-ui {
            max-width: 1200px;
            margin: 0 auto;
        }

        .swagger-ui .topbar {
            display: none;
        }

        .swagger-ui .info .link {
            display: none;
        }
    </style>
</head>
<body>
<div id="swagger-ui"></div>

<script src="https://unpkg.com/swagger-ui-dist@5/swagger-ui-bundle.js"></script>
<script>
    function normalizeServerLabels() {
        document.querySelectorAll('.servers select option').forEach((option) => {
            const parts = option.textContent.split(' - ');

            if (parts.length > 1) {
                option.textContent = parts[1].trim();
            }
        });
    }

    window.onload = function () {
        window.SwaggerUIBundle({
            url: "{{ url('/docs/openapi.yml') }}",
            dom_id: '#swagger-ui',
            presets: [SwaggerUIBundle.presets.apis],
            layout: 'BaseLayout',
            onComplete: normalizeServerLabels,
        });
    };
</script>
</body>
</html>
