# Node.js Express API with Google OAuth

This Node.js/Express application provides authentication using Google OAuth and includes basic API routes.

## Fixed Issues

The original code had several issues that have been resolved:

1. **File Structure**: Split concatenated code into proper separate files:
   - `app.js` - Main application file
   - `passport.js` - Passport configuration
   - `routes/auth.js` - Authentication routes
   - `routes/user.js`, `routes/product.js`, `routes/order.js` - API routes

2. **Syntax Errors**: Fixed missing semicolons and proper line breaks

3. **Duplicate Middleware**: Removed duplicate session middleware (kept cookie-session, removed express-session)

4. **Passport Configuration**: 
   - Added proper module export for passport configuration
   - Fixed authentication scope syntax: `{ scope: ['profile', 'email'] }`
   - Fixed duplicate `failureRedirect` in Google callback route

5. **Error Handling**: Added proper error handling for logout route using callback pattern

6. **Security**: Created `.env.example` without exposing real secrets

## Setup

1. Install dependencies:
   ```bash
   npm install
   ```

2. Copy environment variables:
   ```bash
   cp .env.example .env
   ```

3. Update `.env` with your actual Google OAuth credentials:
   - `CLIENT_ID`: Your Google OAuth client ID
   - `CLIENT_SECRET`: Your Google OAuth client secret  
   - `SESSION_SECRET`: A random string for session encryption

4. Start the server:
   ```bash
   npm start
   ```
   
   Or for development with auto-reload:
   ```bash
   npm run dev
   ```

## API Endpoints

- `GET /` - Health check
- `GET /auth/google` - Initiate Google OAuth
- `GET /auth/google/callback` - Google OAuth callback
- `GET /auth/login/success` - Check authentication status
- `GET /auth/login/failed` - Authentication failure endpoint
- `GET /auth/logout` - Logout user
- `GET /api/users` - User API routes
- `GET /api/products` - Product API routes  
- `GET /api/orders` - Order API routes