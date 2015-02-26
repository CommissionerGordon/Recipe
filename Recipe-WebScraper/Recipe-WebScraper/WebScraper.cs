using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using System.Net;   //allows us to make web requests
using System.IO;

namespace Recipe_WebScraper
{
    class WebScraper
    {
        public static string getSourceCode(string url)
        {
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(url);
            HttpWebResponse response = (HttpWebResponse)request.GetResponse();
            StreamReader source = new StreamReader(response.GetResponseStream());
            string sourceCode = source.ReadToEnd();
            source.Close();
            response.Close();
            string snipOfSourceCode = TextFollowing(sourceCode, "H1");
            return snipOfSourceCode;
        }

        public static string TextFollowing(string searchText, string value) //allows for searching the text after a certain key word or phrase
        {
            if (!String.IsNullOrEmpty(searchText) && !String.IsNullOrEmpty(value))
            {
                int index = searchText.IndexOf(value);
                if (-1 < index)
                {
                    int start = index + value.Length;
                    if (start <= searchText.Length)
                    {
                        return searchText.Substring(start);
                    }
                }
            }
            return null;
        }
    }
}

