# Google Review Widgets

Google Review Widgets is a custom Elementor widget designed to display Google testimonials directly on your WordPress website. Enhance your site with real-time, authentic reviews to build trust and credibility.

---

## Features

- Easily embed Google testimonials on your WordPress site.
- Seamless integration with Elementor.
- Responsive design for a great experience on all devices.
- Lightweight and optimized for performance.
- Fully customizable styles and layouts.

---

## Requirements

- WordPress 5.8 or higher
- PHP 8.1 or higher
- Elementor 3.26.4 or higher

---

## Installation

1. **Upload Plugin Files**:
    - Download the plugin `.zip` file from the [release page](http://wpplugins-googletestimonials.growmeconsulting.ca/google-reviews/google-reviews.zip).
    - Go to your WordPress admin dashboard.
    - Navigate to **Plugins > Add New > Upload Plugin**.
    - Select the `.zip` file and click **Install Now**.

2. **Activate the Plugin**:
    - Once installed, activate the plugin via the **Plugins** page.

---

## Usage

1. **Open Elementor**:
    - Go to any page or post and edit it with Elementor.

2. **Add the Widget**:
    - Search for the **Google Review Widget** in the Elementor widget panel.
    - Drag and drop it onto the page.

3. **Customize**:
    - Configure the widget settings to display your Google testimonials as desired.

---

## Updating the Plugin

This plugin includes a built-in update system. To update:

1. The plugin will notify you of available updates in your WordPress dashboard.
2. Click **Update Now** to install the latest version.

Make sure your WordPress site has access to the plugin’s update server.

---

## Development

### File Structure
- `/` - Main plugin folder.
- `/widgets/` - Contains custom Elementor widgets.
- `/plugin-update-checker-master/` - Handles the plugin update system.
- `google-reviews.php` - Main plugin file.

### Adding Custom Features
Feel free to customize this plugin to meet your specific needs. Pull requests are welcome for contributions.

---

## Plugin Metadata Example

For developers, here’s an example of the metadata used for automatic updates:
here is documentation how plugin updating has been implemented  https://github.com/YahnisElsts/plugin-update-checker

After any changes in sorce code, compress main(plugin) folder to **.zip. Then download compressed file to the project which located on our RunCloud server 
http://wpplugins-googletestimonials.growmeconsulting.ca/google-reviews/

Don't forget update google-reviews-plugin.json and download it to the project folder

```json
{
  "name": "Google Review Widgets",
  "slug": "google-review-widgets",
  "version": "1.0.7",
  "author": "Dmytro Kovalenko",
  "homepage": "https://www.dmytrokovalenko.online/",
  "download_url": "http://wpplugins-googletestimonials.growmeconsulting.ca/google-reviews/google-reviews.zip",
  "requires": "5.8",
  "tested": "6.2",
  "requires_php": "8.1",
  "sections": {
    "description": "Google Review Widgets is a custom Elementor widget for embedding Google testimonials.",
    "changelog": "1.0.7: Added style for slides to make slides animated when mouse over on it."
  }
}