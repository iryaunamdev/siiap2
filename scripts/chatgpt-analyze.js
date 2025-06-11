// chatgpt-analyze.js (Node.js ejemplo)
import OpenAI from "openai";
const openai = new OpenAI({ apiKey: process.env.OPENAI_API_KEY });
const fs = require("fs");
(async () => {
  const code = fs.readFileSync("/", "utf8");
  const resp = await openai.chat.completions.create({
    model: "gpt-4o-mini",
    messages: [
      { role: "system", content: "Actúa como un experto fullstack Laravel, documenta este código." },
      { role: "user", content: code }
    ]
  });
  console.log(resp.choices[0].message.content);
})();
