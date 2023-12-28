import React, { useState, useEffect } from 'react';
import './App.css';

function App() {
  const [ facts, setFacts ] = useState([]);
  const [ listening, setListening ] = useState(false);

  useEffect( () => {
    if (!listening) {
      const events = new EventSource('http://192.168.1.26:3000/events');

      events.onmessage = (event) => {
        const parsedData = JSON.parse(event.data);

        setFacts((facts) => facts.concat(parsedData));
      };

      setListening(true);
    }
  }, [listening, facts]);

  return ;
}

export default App;