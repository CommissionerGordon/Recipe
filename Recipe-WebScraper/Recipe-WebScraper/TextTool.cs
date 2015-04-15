using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Recipe_WebScraper
{
    /// <summary>
    /// Contains static text methods.
    /// Put this in a separate class in your project.
    /// </summary>
    public static class TextTool
    {
        /// <summary>
        /// Count occurrences of strings.
        /// </summary>
        public static int CountStringOccurrences(string text, string pattern)
        {
            // Loop through all instances of the string 'text'.
            int count = 0;
            int i = 0;
            while ((i = text.IndexOf(pattern, i)) != -1)
            {
                i += pattern.Length;
                count++;
            }
            return count;
        }
    }
}
