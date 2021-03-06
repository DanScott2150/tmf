
# TMF Sample Project

## Installation
- Installation consists of installing & activating theme within `themes/tmf/` folder.
- This repo includes the entire `wp-content/` folder, since initially I wasn't sure if I might want or need to include the plugins & uploads folder. However, all project content is contained within the `themes/tmf/` folder.
- A WordPress content export and SQL export are included, but shouldn't necessarily be needed for testing/review. These consist solely of dummy data (post content) generated via a third-party FakerPress plugin.

## Frameworks/Boilerplate/3rd Party Plugins
- Bootstrap.css is included for a very basic level of prototype design.
	- I chose this because I am familiar with it, it is easy to implement, and I feel like it makes easier to think through certain aspects of back-end development if the front-end has at least a minimal level of visual appeal.
	- This is enqueued in `functions.php` via a 3rd party CDN link.

- [FakerPress](https://wordpress.org/plugins/fakerpress/) was used for development purposes to generate dummy data for both post types and associated taxonomies. The data export and SQL export are included within this repo. The FakerPress plugin **is not** included, nor is it necessary for the project's functionality.

## Other Notes
- My build timeline for this project was kept within the suggested 8-10 hour range, probably on the upper end.
	- Some aspects of this project were completed specifically with that time range in mind. I tried to include comments thoughout the files to note my thought process, in terms of things I might do or approaches I might take if this were an ongoing project or a longer deadline.
- My API key (for stock/company info) is hardcoded within the files. **I know that this is a bad practice** and would not do this on a production environment, but figured it would be fine within this context.
	- I understand the approach of using environment variables
	- In the past I've also taken the approach where I add a custom field to a custom settings page within the wp-admin, so the API key is stored and retreived via and database call (depending on who has access to wp-admin).

### Usage of JavaScript
- Per project requirements, JavaScript is being used to fetch & display data:
	- This is used for the 'stock price' API data, as shown on company archive pages. I originally planned on this being my 'designated javascript' component to satisfy project requirements.
	- As I continued the project, I realized that the News Article pagination within the Company archive page (Story 4, part 5) would be well-suited for javascript fetch & display as well.
	- Given that, I considered converting the stock price API fetch into PHP (integrating into the class-data-api.php file, along with the other stock-related API call), but left it as-is in the interest of time constraints.