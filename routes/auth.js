const express = require('express');
const router = express.Router();
const passport = require('passport');

router.get("/login/success", (req, res) => {
    if (req.user) {
        res.status(200).json({
            error: false,
            message: "Successfully authenticated",
            user: req.user
        });
    } else {
        res.status(403).json({ message: "Not authorized" });
    }
});

router.get("/login/failed", (req, res) => {
    res.status(401).json({
        error: true,
        message: "Failed to authenticate.."
    });
});

router.get("/google/callback", passport.authenticate("google", {
    successRedirect: process.env.CLIENT_URL,
    failureRedirect: "/auth/login/failed"
}));

router.get('/google', passport.authenticate('google', { scope: ['profile', 'email'] }));

router.get('/logout', (req, res, next) => {
    req.logout((err) => {
        if (err) {
            return next(err);
        }
        res.redirect(process.env.CLIENT_URL);
    });
});

module.exports = router;