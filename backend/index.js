import express from 'express';
import cors from 'cors';
import fetch from 'node-fetch';

const app = express();
const api_key = '4ec327e462149c3710d63be84b81cf4f';

app.use(cors());
app.listen(3333);

app.get('/', (req, res) => {
  res.json('MOVIE API WORKING...');
});

app.get('/genre/movie/list', async (req, res) => {
  const resp = await fetch(`https://api.themoviedb.org/3/genre/movie/list?api_key=${api_key}`);
  const data = await resp.json();

  res.json(data);
});

app.get('/discover/movie/:genre', async (req, res) => {
  const { genre } = req.params;

  const resp = await fetch(`https://api.themoviedb.org/3/discover/movie/?api_key=${api_key}&with_genres=${genre}`);
  const data = await resp.json();

  res.json(data);
});

app.get('/trending', async (req, res) => {
  const resp = await fetch(`https://api.themoviedb.org/3/trending/movie/day?api_key=${api_key}`);
  const data = await resp.json();

  res.json(data);
});

app.get('/search/movie/:query', async (req, res) => {
  const { query } = req.params;

  const resp = await fetch(`https://api.themoviedb.org/3/search/movie/?api_key=${api_key}&query=${query}`);
  const data = await resp.json();

  res.json(data);
});

app.get('/movie/:id', async (req, res) => {
  const { id } = req.params;

  const resp = await fetch(`https://api.themoviedb.org/3/movie/${id}?api_key=${api_key}`);
  const data = await resp.json();

  res.json(data);
});