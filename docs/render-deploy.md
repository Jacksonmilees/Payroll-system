## Deploying to Render

The project now includes a Dockerfile that pins PHP 7.4, Node 14, Apache, and all build steps needed to run this Laravel 7 application on Render.

### Prerequisites
- A Render account with the Starter (or higher) plan.
- A MySQL-compatible database (Render managed MySQL, Azure, RDS, etc.).
- The app repository hosted on GitHub/GitLab.

### Steps
1. Commit/push the following files (already added):
   - `Dockerfile`
   - `.dockerignore`
   - `render.yaml`
2. On Render, choose **New +** → **Blueprint** and point it to your repository. Render will read `render.yaml` and create a Web Service.
3. In the Render dashboard, set the environment variables flagged as `sync: false`:
   - `APP_KEY` – run `php artisan key:generate --show` locally and paste the value.
   - `APP_URL` – e.g. `https://your-app.onrender.com`.
   - `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` – match your database credentials.
4. (Optional) Add other variables you need (`MAIL_*`, `QUEUE_CONNECTION`, etc.).
5. Trigger the deploy. The Dockerfile will:
   - Install PHP extensions and Node 14.
   - Install Composer dependencies (`--no-dev`).
   - Install Node deps and run `npm run production`.
   - Set Apache’s document root to `public/`.
6. After the service is healthy, run any required migrations from the Render dashboard (`Shell` → `php artisan migrate --force`) or add a “Post Deploy” command if you want it automatic.

### Notes
- Render containers are ephemeral; use external object storage if you need persistent file uploads.
- Logs are viewable via Render’s dashboard (`Logs` tab).
- To redeploy, push to your repo; auto-deploy is enabled in `render.yaml`.


