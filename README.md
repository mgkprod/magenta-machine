<p align="center"><img src="https://i.imgur.com/UQwTGHK.png" alt="Header"></p>

# MAGENTA MACHINE

Simple soundboard made with Tailwind CSS and howler.js.

## Tech Stack

- Tailwind CSS (3)
- howler.js
- Vue.js (3)
- Vite

## Usage

```bash
npm ci
npm run dev
```

Visit `http://localhost:5173` to use the app. Any changes made to the code will be reflected in real-time.

### Build

```bash
npm ci
npm run build
```

This will create a `dist` folder with all the files needed to deploy the app.

## Notes

- The sound files are included in the repository. You can add your own sound files to the `public/audio` folder and update the `mounted` function in `src/components/Machine.vue` to load the new files.

## Credits

- [Simon Rubuano](https://github.com/mgkprod)

## License

Copyright (c) 2020-2024 Simon Rubuano (@mgkprod) and contributors

Licensed under the MIT license, see [LICENSE.md](LICENSE.md) for details.
