using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using System.Net;   //allows us to make web requests
using System.IO;
using System.Text.RegularExpressions; // allows us to Split using Regex
using System.Windows.Forms;

namespace Recipe_WebScraper
{
    class WebScraper
    {
        /// <summary>
        /// Gets raw HTML web page source from the given URL.
        /// </summary>
        /// <param name="URL">The url of the web page containing either the recipe information,
        /// or the page with the list of individual recipe URL's</param>
        /// <returns>string</returns>
        public static string getSourceCode(string URL, bool checkBoxState)
        {
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(URL);
            HttpWebResponse response = (HttpWebResponse)request.GetResponse();
            StreamReader source = new StreamReader(response.GetResponseStream());
            string sourceCode = source.ReadToEnd();
            source.Close();
            response.Close();

            if (checkBoxState == false)
            {
                string recipeDetails = getRecipeDetails(sourceCode);
                sourceCode = recipeDetails;
            }
            else
            {
                sourceCode = getLinksToScrape(sourceCode).ToString();
            }

            return sourceCode;
        }

        /// <summary>
        /// Allows for searching the HTML source after a certain key word or phrase.
        /// </summary>
        /// <param name="searchText"></param>
        /// <param name="value"></param>
        /// <returns>string OR null</returns>
        public static string textFollowing(string searchText, string value)
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

        /// <summary>
        /// This method retrives all the links on a page (or in a frame,
        /// in the case of Webtender.com).
        /// </summary>
        /// <param name="sourceCode">The raw HTML source code from getSourceCode().</param>
        /// <returns>string</returns>
        public static string getLinksToScrape(string sourceCode)
        {
            string snipOfSourceCode;
            string linkRoot = "http://webtender.com";
            string[] snipValue;
            int numLinks = TextTool.CountStringOccurrences(sourceCode, "<LI>");

            snipOfSourceCode = textFollowing(sourceCode, "<UL>");
            snipValue = snipOfSourceCode.Split('T');

            // Begins separating the link text.
            snipOfSourceCode = textFollowing(sourceCode, "<UL>");
            snipValue = Regex.Split(snipOfSourceCode, "</A>");

            // Builds each link into the snipValue array.
            for (int count = 0; count < (numLinks); count++)
            {
                string[] temp = {};
                temp = Regex.Split(snipValue[count], "\"");
                snipValue[count] = linkRoot + temp[1];
            }

            //links = string.Join(",", listOfLinks.ToArray());

            return snipValue[14];
        }

        /// <summary>
        /// Carves out the recipe information: title, measurement of each ingredient,
        /// name of each ingredient, mixing instructions, and the "creator's comments",
        /// referred to in this method as "comments".
        /// </summary>
        /// <param name="sourceCode">This parameter comes from the getSourceCode() method
        /// and provides the raw HTML page source.</param>
        /// <returns>string[]</returns>
        public static string getRecipeDetails(string sourceCode)
        {
            string snipOfSourceCode;
            //string[] dbColumnNames = { "recipeName", 
            string[] snipValue;
            string[] recipeDetails = {};
            string recipeSQLstatement = "INSERT INTO TestTable (recipeName) VALUES ('";

            // Gets recipe title
            try
            {
                snipOfSourceCode = textFollowing(sourceCode, "<H1>");
                snipValue = snipOfSourceCode.Split('<');
                recipeSQLstatement += snipValue[0] + "');";
            }
            catch
            {
                MessageBox.Show("It appears that you are scraping a links page \nwithout checking the box.",
                    "Error",
                    MessageBoxButtons.OK,
                    MessageBoxIcon.Exclamation,
                    MessageBoxDefaultButton.Button1);
            }

            // Gets measurements and ingredients
            int numIngredients = TextTool.CountStringOccurrences(sourceCode, "<LI>");
            numIngredients -= 5;

            for (int counter = 0; counter < numIngredients; counter++)
            {

            }

            //// Gets measurement of first ingredient
            //snipOfSourceCode = textFollowing(sourceCode, "<LI>");
            //snipValue = Regex.Split(snipOfSourceCode, "<A");
            //snipOfSourceCode = snipValue[0];

            //// Gets name of first ingredient
            //snipOfSourceCode = textFollowing(snipValue[1], ">");
            //snipValue = Regex.Split(snipOfSourceCode, "<");
            //snipOfSourceCode = snipValue[0];

            //string loopCounterString = numIngredients.ToString();
            //return loopCounterString;
            //return snipValue[0];

            return recipeSQLstatement;
        }

        public static string[] scrapeLinks(string linksURL)
        {
            string[] listoOfLinks = { };

            //// Gets list of links
            //snipOfSourceCode = textFollowing(sourceCode, "<LI>");
            //snipValue = Regex.Split(snipOfSourceCode, "<A");
            //snipOfSourceCode = snipValue[0];

            return listoOfLinks;
        }
    }
}